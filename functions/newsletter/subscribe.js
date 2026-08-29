/**
 * Cloudflare Pages Function — Listmonk newsletter subscribe.
 * Route: POST /newsletter/subscribe
 *
 * Requires Pages secrets: LISTMONK_URL, LISTMONK_API_USER, LISTMONK_API_TOKEN, LISTMONK_LIST_ID
 */
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

  const base = String(env.LISTMONK_URL || '').replace(/\/$/, '');
  const user = env.LISTMONK_API_USER;
  const token = env.LISTMONK_API_TOKEN;
  const listId = Number(env.LISTMONK_LIST_ID);

  if (!base || !user || !token || !listId) {
    return json({ ok: false, message: 'Newsletter is not configured.' }, 503);
  }

  const auth = btoa(`${user}:${token}`);
  const headers = {
    Authorization: `Basic ${auth}`,
    'Content-Type': 'application/json',
    Accept: 'application/json',
  };

  const createRes = await fetch(`${base}/api/subscribers`, {
    method: 'POST',
    headers,
    body: JSON.stringify({
      email,
      name: email.split('@')[0] || 'Subscriber',
      status: 'enabled',
      lists: [listId],
      preconfirm_subscriptions: true,
      attribs: { source: 'electrik.dev' },
    }),
  });

  if (createRes.ok) {
    return json({ ok: true, message: 'You are on the list. Watch for Electrik updates.' });
  }

  const createText = await createRes.text();
  const alreadyExists =
    createRes.status === 409 || /already exists|duplicate|unique/i.test(createText);

  if (!alreadyExists) {
    console.error('listmonk create failed', createRes.status, createText.slice(0, 300));
    return json({ ok: false, message: 'Could not subscribe right now. Try again in a moment.' }, 502);
  }

  // Existing subscriber: attach Electrik list without wiping others
  const findRes = await fetch(
    `${base}/api/subscribers?query=${encodeURIComponent(`subscribers.email = '${email.replace(/'/g, "''")}'`)}&page=1&per_page=1`,
    { headers },
  );

  if (!findRes.ok) {
    return json({ ok: true, message: 'You are on the list. Watch for Electrik updates.' });
  }

  const found = await findRes.json();
  const sub = found?.data?.results?.[0];
  if (!sub) {
    return json({ ok: true, message: 'You are on the list. Watch for Electrik updates.' });
  }

  const existingIds = (sub.lists || []).map((l) => l.id);
  if (existingIds.includes(listId)) {
    return json({ ok: true, message: 'You are on the list. Watch for Electrik updates.' });
  }

  const patchRes = await fetch(`${base}/api/subscribers/${sub.id}`, {
    method: 'PUT',
    headers,
    body: JSON.stringify({
      email: sub.email,
      name: sub.name || email.split('@')[0],
      status: sub.status || 'enabled',
      lists: [...existingIds, listId],
      preconfirm_subscriptions: true,
    }),
  });

  if (!patchRes.ok) {
    const listsRes = await fetch(`${base}/api/subscribers/lists`, {
      method: 'PUT',
      headers,
      body: JSON.stringify({
        ids: [sub.id],
        action: 'add',
        target_list_ids: [listId],
        status: 'confirmed',
      }),
    });
    if (!listsRes.ok) {
      console.error('listmonk attach list failed', await listsRes.text());
      return json({ ok: false, message: 'Could not subscribe right now. Try again in a moment.' }, 502);
    }
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
