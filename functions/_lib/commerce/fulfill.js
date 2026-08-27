import { tierForProductId } from './catalog.js';
import { sendLicenseEmail, sendOpsAlert } from './mail.js';

export async function processCommerceEvent(db, env, eventType, data, webhookId) {
  switch (eventType) {
    case 'payment.processing':
      return upsertPayment(db, env, data, 'processing');
    case 'payment.succeeded':
      return handlePaymentSucceeded(db, env, data);
    case 'payment.failed':
      return handlePaymentFailed(db, env, data);
    case 'payment.cancelled':
      return upsertPayment(db, env, data, 'cancelled');
    case 'refund.succeeded':
      return handleRefund(db, env, data);
    case 'entitlement_grant.delivered':
    case 'entitlement_grant.created':
      return handleEntitlementGrant(db, env, data, eventType);
    case 'entitlement_grant.revoked':
      return handleEntitlementRevoked(db, env, data);
    case 'license_key.created':
      return handleLegacyLicenseKey(db, env, data);
    default:
      return { handled: false, note: `no handler for ${eventType}` };
  }
}

async function handlePaymentSucceeded(db, env, data) {
  const purchase = await upsertPayment(db, env, data, 'succeeded');
  // License key often arrives via entitlement_grant.*; if already present, email now.
  if (purchase?.license_key) {
    await fulfillEmail(db, env, purchase);
  } else {
    await sendOpsAlert(
      env,
      `[Electrik] Payment succeeded — awaiting license key`,
      `payment_id=${purchase.payment_id}\nemail=${purchase.email}\ntier=${purchase.tier}\nproduct_id=${purchase.product_id}`,
    );
  }
  return { handled: true, purchase };
}

async function handlePaymentFailed(db, env, data) {
  const purchase = await upsertPayment(db, env, data, 'failed');
  await sendOpsAlert(
    env,
    `[Electrik] Payment failed`,
    `payment_id=${purchase.payment_id}\nemail=${purchase.email}\nerror=${data.error_code || ''} ${data.error_message || ''}`,
  );
  return { handled: true, purchase };
}

async function handleRefund(db, env, data) {
  const paymentId = data.payment_id || data.payment?.payment_id;
  if (!paymentId) {
    return { handled: false, note: 'refund missing payment_id' };
  }
  await db
    .prepare(
      `UPDATE purchases
       SET status = 'refunded', revoked_at = datetime('now'), updated_at = datetime('now')
       WHERE payment_id = ?`,
    )
    .bind(paymentId)
    .run();

  const purchase = await getPurchase(db, paymentId);
  await sendOpsAlert(
    env,
    `[Electrik] Refund — revoke license`,
    `payment_id=${paymentId}\nemail=${purchase?.email || '?'}\nlicense_key=${purchase?.license_key || '(none)'}`,
  );
  return { handled: true, purchase };
}

async function handleEntitlementGrant(db, env, data, eventType) {
  // Grant payloads vary; normalize.
  const paymentId =
    data.payment_id ||
    data.payment?.payment_id ||
    data.metadata?.payment_id ||
    null;
  const email = data.customer?.email || data.email || null;
  const productId = data.product_id || data.product?.product_id || null;
  const licenseKey =
    data.license_key?.key ||
    data.license_key?.license_key ||
    (typeof data.license_key === 'string' ? data.license_key : null);
  const licenseKeyId = data.license_key?.id || data.license_key?.license_key_id || null;
  const grantId = data.grant_id || data.id || null;

  if (!paymentId && !email) {
    return { handled: false, note: 'entitlement grant missing payment/email' };
  }

  if (paymentId) {
    await db
      .prepare(
        `UPDATE purchases
         SET license_key = COALESCE(?, license_key),
             license_key_id = COALESCE(?, license_key_id),
             entitlement_grant_id = COALESCE(?, entitlement_grant_id),
             status = CASE WHEN status = 'refunded' THEN status ELSE 'succeeded' END,
             fulfilled_at = COALESCE(fulfilled_at, datetime('now')),
             updated_at = datetime('now')
         WHERE payment_id = ?`,
      )
      .bind(licenseKey, licenseKeyId, grantId, paymentId)
      .run();
  } else if (email && productId) {
    // Attach to latest succeeded purchase for this email+product
    await db
      .prepare(
        `UPDATE purchases
         SET license_key = COALESCE(?, license_key),
             license_key_id = COALESCE(?, license_key_id),
             entitlement_grant_id = COALESCE(?, entitlement_grant_id),
             fulfilled_at = COALESCE(fulfilled_at, datetime('now')),
             updated_at = datetime('now')
         WHERE payment_id = (
           SELECT payment_id FROM purchases
           WHERE email = ? AND product_id = ? AND status = 'succeeded'
           ORDER BY created_at DESC LIMIT 1
         )`,
      )
      .bind(licenseKey, licenseKeyId, grantId, email, productId)
      .run();
  }

  const purchase = paymentId
    ? await getPurchase(db, paymentId)
    : await getLatestPurchase(db, email, productId);

  if (purchase && licenseKey && eventType === 'entitlement_grant.delivered') {
    await fulfillEmail(db, env, { ...purchase, license_key: licenseKey });
  }

  return { handled: true, purchase, eventType };
}

async function handleEntitlementRevoked(db, env, data) {
  const paymentId = data.payment_id || data.payment?.payment_id;
  const licenseKeyId = data.license_key?.id || data.license_key_id;
  if (paymentId) {
    await db
      .prepare(
        `UPDATE purchases SET revoked_at = datetime('now'), updated_at = datetime('now') WHERE payment_id = ?`,
      )
      .bind(paymentId)
      .run();
  } else if (licenseKeyId) {
    await db
      .prepare(
        `UPDATE purchases SET revoked_at = datetime('now'), updated_at = datetime('now') WHERE license_key_id = ?`,
      )
      .bind(licenseKeyId)
      .run();
  }
  await sendOpsAlert(env, `[Electrik] License revoked`, JSON.stringify(data).slice(0, 2000));
  return { handled: true };
}

async function handleLegacyLicenseKey(db, env, data) {
  // Bridge legacy license_key.created into the same path
  return handleEntitlementGrant(db, env, {
    ...data,
    license_key: data.key ? { key: data.key, id: data.id } : data.license_key,
    payment_id: data.payment_id,
    customer: data.customer,
    product_id: data.product_id,
  }, 'entitlement_grant.delivered');
}

async function upsertPayment(db, env, data, status) {
  const paymentId = data.payment_id;
  if (!paymentId) {
    throw new Error('payment payload missing payment_id');
  }

  const email = (data.customer?.email || '').toLowerCase();
  const name = data.customer?.name || null;
  const customerId = data.customer?.customer_id || null;
  const productId =
    data.product_id ||
    data.product_cart?.[0]?.product_id ||
    data.metadata?.product_id ||
    'unknown';
  const tier = tierForProductId(productId, env);
  const amount = data.total_amount ?? data.amount ?? null;
  const currency = data.currency || null;

  if (customerId && email) {
    await db
      .prepare(
        `INSERT INTO customers (dodo_customer_id, email, name, created_at, updated_at)
         VALUES (?, ?, ?, datetime('now'), datetime('now'))
         ON CONFLICT(dodo_customer_id) DO UPDATE SET
           email = excluded.email,
           name = COALESCE(excluded.name, customers.name),
           updated_at = datetime('now')`,
      )
      .bind(customerId, email, name)
      .run();
  }

  await db
    .prepare(
      `INSERT INTO purchases (
         payment_id, dodo_customer_id, email, name, product_id, tier, status,
         amount, currency, metadata, error_code, error_message, created_at, updated_at
       ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))
       ON CONFLICT(payment_id) DO UPDATE SET
         dodo_customer_id = COALESCE(excluded.dodo_customer_id, purchases.dodo_customer_id),
         email = CASE WHEN excluded.email != '' THEN excluded.email ELSE purchases.email END,
         name = COALESCE(excluded.name, purchases.name),
         product_id = CASE WHEN excluded.product_id != 'unknown' THEN excluded.product_id ELSE purchases.product_id END,
         tier = CASE WHEN excluded.tier != 'unknown' THEN excluded.tier ELSE purchases.tier END,
         status = excluded.status,
         amount = COALESCE(excluded.amount, purchases.amount),
         currency = COALESCE(excluded.currency, purchases.currency),
         error_code = excluded.error_code,
         error_message = excluded.error_message,
         updated_at = datetime('now')`,
    )
    .bind(
      paymentId,
      customerId,
      email || 'unknown@unknown',
      name,
      productId,
      tier,
      status,
      amount,
      currency,
      JSON.stringify(data.metadata || {}),
      data.error_code || null,
      data.error_message || null,
    )
    .run();

  return getPurchase(db, paymentId);
}

async function fulfillEmail(db, env, purchase) {
  const result = await sendLicenseEmail(env, purchase);
  await db
    .prepare(
      `INSERT INTO outbound_emails (payment_id, to_email, template, provider_message_id, status, error_message)
       VALUES (?, ?, 'license', ?, ?, ?)`,
    )
    .bind(
      purchase.payment_id,
      purchase.email,
      result.id || null,
      result.ok ? 'sent' : result.skipped ? 'queued' : 'failed',
      result.error || null,
    )
    .run();

  if (result.ok) {
    await db
      .prepare(
        `UPDATE purchases SET fulfilled_at = COALESCE(fulfilled_at, datetime('now')), updated_at = datetime('now') WHERE payment_id = ?`,
      )
      .bind(purchase.payment_id)
      .run();
  }
  return result;
}

export async function getPurchase(db, paymentId) {
  return db.prepare(`SELECT * FROM purchases WHERE payment_id = ?`).bind(paymentId).first();
}

async function getLatestPurchase(db, email, productId) {
  return db
    .prepare(
      `SELECT * FROM purchases WHERE email = ? AND product_id = ? ORDER BY created_at DESC LIMIT 1`,
    )
    .bind(email, productId)
    .first();
}
