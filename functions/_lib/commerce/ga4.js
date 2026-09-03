import { TIER_LABELS } from './catalog.js';

/**
 * Gold-standard purchase: server-side GA4 Measurement Protocol.
 * Only call after payment.succeeded is verified. Idempotent via purchases.ga_purchase_sent_at.
 *
 * Requires Pages secrets/vars:
 *   GOOGLE_ANALYTICS_MEASUREMENT_ID (or GA_MEASUREMENT_ID) — G-XXXXXXXX
 *   GA4_API_SECRET — Admin → Data stream → Measurement Protocol API secrets
 *
 * Docs: https://developers.google.com/analytics/devguides/collection/protocol/ga4
 */
export async function trackPurchaseInGa4(db, env, purchase) {
  if (!purchase?.payment_id) {
    return { ok: false, skipped: true, reason: 'missing_payment_id' };
  }

  if (purchase.ga_purchase_sent_at) {
    return { ok: true, skipped: true, reason: 'already_sent' };
  }

  const measurementId =
    env.GOOGLE_ANALYTICS_MEASUREMENT_ID || env.GA_MEASUREMENT_ID || '';
  const apiSecret = env.GA4_API_SECRET || '';

  if (!measurementId || !apiSecret) {
    return { ok: false, skipped: true, reason: 'ga4_not_configured' };
  }

  const tier = purchase.tier || 'unknown';
  const itemName = TIER_LABELS[tier] || TIER_LABELS.unknown;
  // Dodo amounts are smallest currency unit (cents).
  const value =
    purchase.amount != null && purchase.amount !== ''
      ? Number(purchase.amount) / 100
      : tier === 'solo'
        ? 99
        : tier === 'studio'
          ? 149
          : 0;
  const currency = (purchase.currency || 'USD').toUpperCase();
  const clientId = `dodo.${String(purchase.payment_id).replace(/[^A-Za-z0-9_-]/g, '')}`;

  const body = {
    client_id: clientId,
    // Prefer payment_id so browser + server events with the same id de-dupe in GA4 (~72h).
    events: [
      {
        name: 'purchase',
        params: {
          transaction_id: purchase.payment_id,
          value,
          currency,
          engagement_time_msec: 1,
          items: [
            {
              item_id: purchase.product_id || tier,
              item_name: itemName,
              item_category: 'commercial_license',
              item_variant: tier,
              price: value,
              quantity: 1,
            },
          ],
        },
      },
    ],
  };

  const url = `https://www.google-analytics.com/mp/collect?measurement_id=${encodeURIComponent(measurementId)}&api_secret=${encodeURIComponent(apiSecret)}`;

  let response;
  try {
    response = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(body),
    });
  } catch (err) {
    return { ok: false, error: String(err?.message || err) };
  }

  // MP collect returns 2xx with empty body on success (even for some invalid payloads).
  if (!response.ok) {
    const text = await response.text().catch(() => '');
    return { ok: false, error: `ga4_http_${response.status}:${text.slice(0, 200)}` };
  }

  await db
    .prepare(
      `UPDATE purchases
       SET ga_purchase_sent_at = COALESCE(ga_purchase_sent_at, datetime('now')),
           updated_at = datetime('now')
       WHERE payment_id = ?`,
    )
    .bind(purchase.payment_id)
    .run();

  return { ok: true, value, currency, transaction_id: purchase.payment_id };
}
