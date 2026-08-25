/**
 * Cloudflare Pages Function — Kit newsletter subscribe.
 * Route: POST /newsletter/subscribe
 *
 * Requires Pages env: KIT_API_KEY, KIT_FORM_ID (optional, defaults below).
 */
const KIT_FORM_ID_DEFAULT = '9841384';

export async function onRequestPost(context) {
  const { request, env } = context;

  let body;
  try {
    body = await request.json();
  } catch {
    return json({ ok: false, message: 'Invalid JSON body.' }, 400);
  }

  // Honeypot
  if (body?.company_website) {
    return json({ ok: true, message: 'You are on the list. Watch for Electrik updates.' });
  }

  const email = String(body?.email || '')
    .trim()
    .toLowerCase();
  if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    return json({ ok: false, message: 'Enter a valid email address.' }, 422);
  }

  const apiKey = env.KIT_API_KEY;
  const formId = env.KIT_FORM_ID || KIT_FORM_ID_DEFAULT;
  if (!apiKey) {
    return json({ ok: false, message: 'Newsletter is not configured.' }, 503);
  }

  const referrer = request.headers.get('referer') || 'https://electrik.dev';
  const headers = {
    'X-Kit-Api-Key': apiKey,
    Accept: 'application/json',
    'Content-Type': 'application/json',
  };

  const createRes = await fetch('https://api.kit.com/v4/subscribers', {
    method: 'POST',
    headers,
    body: JSON.stringify({ email_address: email }),
  });

  if (!createRes.ok && ![409, 422].includes(createRes.status)) {
    return json({ ok: false, message: 'Could not subscribe right now. Try again in a moment.' }, 502);
  }

  const addRes = await fetch(`https://api.kit.com/v4/forms/${formId}/subscribers`, {
    method: 'POST',
    headers,
    body: JSON.stringify({ email_address: email, referrer }),
  });

  if (!addRes.ok && addRes.status !== 200) {
    return json({ ok: false, message: 'Could not subscribe right now. Try again in a moment.' }, 502);
  }

  return json({ ok: true, message: 'You are on the list. Watch for Electrik updates.' });
}

export async function onRequestOptions() {
  return new Response(null, {
    status: 204,
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'POST, OPTIONS',
      'Access-Control-Allow-Headers': 'Content-Type',
    },
  });
}

function json(payload, status = 200) {
  return new Response(JSON.stringify(payload), {
    status,
    headers: {
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin': '*',
    },
  });
}
