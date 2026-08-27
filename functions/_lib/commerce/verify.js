/**
 * Standard Webhooks verification (Dodo Payments).
 * Spec: https://github.com/standard-webhooks/standard-webhooks
 */
export async function verifyDodoWebhook(rawBody, headers, webhookSecret) {
  if (!webhookSecret) {
    throw new Error('DODO_PAYMENTS_WEBHOOK_KEY is not configured');
  }

  const id = headers['webhook-id'] || headers.get?.('webhook-id') || '';
  const timestamp = headers['webhook-timestamp'] || headers.get?.('webhook-timestamp') || '';
  const signatureHeader = headers['webhook-signature'] || headers.get?.('webhook-signature') || '';

  if (!id || !timestamp || !signatureHeader) {
    throw new Error('Missing webhook signature headers');
  }

  // Reject stale timestamps (±5 minutes)
  const ts = Number(timestamp);
  if (!Number.isFinite(ts)) {
    throw new Error('Invalid webhook timestamp');
  }
  const now = Math.floor(Date.now() / 1000);
  if (Math.abs(now - ts) > 300) {
    throw new Error('Webhook timestamp outside tolerance');
  }

  const secretBytes = decodeWebhookSecret(webhookSecret);
  const encoder = new TextEncoder();
  const toSign = encoder.encode(`${id}.${timestamp}.${rawBody}`);

  const key = await crypto.subtle.importKey(
    'raw',
    secretBytes,
    { name: 'HMAC', hash: 'SHA-256' },
    false,
    ['sign'],
  );
  const sigBuf = await crypto.subtle.sign('HMAC', key, toSign);
  const expected = bufferToBase64(sigBuf);

  const candidates = signatureHeader
    .split(' ')
    .map((part) => part.trim())
    .filter(Boolean)
    .map((part) => {
      const [, value] = part.split(',', 2);
      return value || part.replace(/^v1,/, '');
    });

  const ok = candidates.some((c) => timingSafeEqual(c, expected));
  if (!ok) {
    throw new Error('Webhook signature mismatch');
  }

  return JSON.parse(rawBody);
}

function decodeWebhookSecret(secret) {
  const raw = secret.startsWith('whsec_') ? secret.slice('whsec_'.length) : secret;
  // Standard Webhooks secrets are base64
  try {
    const bin = atob(raw);
    const bytes = new Uint8Array(bin.length);
    for (let i = 0; i < bin.length; i++) bytes[i] = bin.charCodeAt(i);
    return bytes;
  } catch {
    // Fallback: treat as utf-8 secret string
    return new TextEncoder().encode(secret);
  }
}

function bufferToBase64(buf) {
  const bytes = new Uint8Array(buf);
  let binary = '';
  for (const b of bytes) binary += String.fromCharCode(b);
  return btoa(binary);
}

function timingSafeEqual(a, b) {
  if (typeof a !== 'string' || typeof b !== 'string' || a.length !== b.length) {
    return false;
  }
  let out = 0;
  for (let i = 0; i < a.length; i++) {
    out |= a.charCodeAt(i) ^ b.charCodeAt(i);
  }
  return out === 0;
}
