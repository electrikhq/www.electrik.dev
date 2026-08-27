import { verifyDodoWebhook } from '../../_lib/commerce/verify.js';
import { processCommerceEvent } from '../../_lib/commerce/fulfill.js';
import { json } from '../../_lib/commerce/http.js';

/**
 * POST /api/commerce/webhook
 * Dodo Payments → Electrik commercial license ledger.
 */
export async function onRequestPost(context) {
  const { request, env } = context;
  const db = env.DB;

  if (!db) {
    return json({ error: 'D1 binding DB is not configured' }, 503);
  }

  const rawBody = await request.text();
  const webhookId = request.headers.get('webhook-id') || '';

  let payload;
  try {
    payload = await verifyDodoWebhook(
      rawBody,
      {
        'webhook-id': webhookId,
        'webhook-signature': request.headers.get('webhook-signature') || '',
        'webhook-timestamp': request.headers.get('webhook-timestamp') || '',
      },
      env.DODO_PAYMENTS_WEBHOOK_KEY,
    );
  } catch (err) {
    console.error(JSON.stringify({ commerce: 'verify_failed', error: String(err?.message || err) }));
    return json({ error: 'invalid signature' }, 401);
  }

  const eventType = payload.type || 'unknown';
  const data = payload.data || {};

  // Idempotency: if we already processed this webhook-id, ack and stop.
  if (webhookId) {
    const existing = await db
      .prepare(`SELECT webhook_id, processed FROM webhook_events WHERE webhook_id = ?`)
      .bind(webhookId)
      .first();
    if (existing?.processed) {
      return json({ ok: true, duplicate: true });
    }
    if (!existing) {
      await db
        .prepare(
          `INSERT INTO webhook_events (webhook_id, event_type, payload, processed, attempts)
           VALUES (?, ?, ?, 0, 1)`,
        )
        .bind(webhookId, eventType, rawBody)
        .run();
    } else {
      await db
        .prepare(`UPDATE webhook_events SET attempts = attempts + 1 WHERE webhook_id = ?`)
        .bind(webhookId)
        .run();
    }
  }

  try {
    const result = await processCommerceEvent(db, env, eventType, data, webhookId);
    if (webhookId) {
      await db
        .prepare(
          `UPDATE webhook_events
           SET processed = 1, processed_at = datetime('now'), error_message = NULL
           WHERE webhook_id = ?`,
        )
        .bind(webhookId)
        .run();
    }
    return json({ ok: true, event_type: eventType, result });
  } catch (err) {
    const message = err instanceof Error ? err.message : String(err);
    console.error(JSON.stringify({ commerce: 'process_failed', eventType, message }));
    if (webhookId) {
      await db
        .prepare(
          `UPDATE webhook_events
           SET processed = 0, error_message = ?, processed_at = datetime('now')
           WHERE webhook_id = ?`,
        )
        .bind(message.slice(0, 1000), webhookId)
        .run();
    }
    // 500 so Dodo retries
    return json({ error: 'processing failed', details: message }, 500);
  }
}

export async function onRequestOptions() {
  return new Response(null, {
    status: 204,
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'POST, OPTIONS',
      'Access-Control-Allow-Headers':
        'Content-Type, webhook-id, webhook-signature, webhook-timestamp',
    },
  });
}
