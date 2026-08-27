export function json(payload, status = 200, extraHeaders = {}) {
  return new Response(JSON.stringify(payload), {
    status,
    headers: {
      'Content-Type': 'application/json',
      ...extraHeaders,
    },
  });
}

export async function requireAdmin(request, env) {
  const token = env.COMMERCE_ADMIN_TOKEN;
  if (!token) {
    return json({ error: 'Admin token not configured' }, 503);
  }
  const auth = request.headers.get('authorization') || '';
  const expected = `Bearer ${token}`;
  if (auth !== expected) {
    return json({ error: 'Unauthorized' }, 401);
  }
  return null;
}
