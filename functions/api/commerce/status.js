import { json } from '../../_lib/commerce/http.js';

/**
 * GET /api/commerce/status?payment_id=pay_…
 * Public, minimal — for /pricing/thanks polling. No license key in response.
 */
export async function onRequestGet(context) {
  const { request, env } = context;
  const db = env.DB;
  if (!db) {
    return json({ error: 'not configured' }, 503);
  }

  const url = new URL(request.url);
  const paymentId = url.searchParams.get('payment_id') || '';
  if (!paymentId || !/^pay_[A-Za-z0-9_-]+$/.test(paymentId)) {
    return json({ error: 'payment_id required' }, 422);
  }

  const row = await db
    .prepare(
      `SELECT payment_id, tier, status, fulfilled_at, revoked_at, created_at, updated_at,
              CASE WHEN license_key IS NOT NULL AND license_key != '' THEN 1 ELSE 0 END AS has_license
       FROM purchases WHERE payment_id = ?`,
    )
    .bind(paymentId)
    .first();

  if (!row) {
    return json({ found: false, status: 'unknown' });
  }

  return json({
    found: true,
    payment_id: row.payment_id,
    tier: row.tier,
    status: row.status,
    has_license: Boolean(row.has_license),
    fulfilled: Boolean(row.fulfilled_at),
    revoked: Boolean(row.revoked_at),
  });
}
