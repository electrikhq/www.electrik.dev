import { json, requireAdmin } from '../../../_lib/commerce/http.js';

/**
 * GET /api/commerce/admin/purchases?limit=50&status=succeeded
 * Authorization: Bearer $COMMERCE_ADMIN_TOKEN
 */
export async function onRequestGet(context) {
  const { request, env } = context;
  const denied = await requireAdmin(request, env);
  if (denied) return denied;

  const db = env.DB;
  if (!db) return json({ error: 'not configured' }, 503);

  const url = new URL(request.url);
  const limit = Math.min(Number(url.searchParams.get('limit') || 50), 200);
  const status = url.searchParams.get('status');
  const email = url.searchParams.get('email');

  let sql = `SELECT payment_id, email, name, product_id, tier, status, amount, currency,
                    license_key, fulfilled_at, revoked_at, created_at, updated_at,
                    error_code, error_message
             FROM purchases`;
  const binds = [];
  const where = [];
  if (status) {
    where.push('status = ?');
    binds.push(status);
  }
  if (email) {
    where.push('email = ?');
    binds.push(email.toLowerCase());
  }
  if (where.length) sql += ` WHERE ${where.join(' AND ')}`;
  sql += ` ORDER BY created_at DESC LIMIT ?`;
  binds.push(limit);

  const stmt = db.prepare(sql);
  const { results } = await stmt.bind(...binds).all();
  return json({ ok: true, count: results?.length || 0, purchases: results || [] });
}
