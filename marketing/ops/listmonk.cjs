#!/usr/bin/env node
/**
 * Listmonk helper for Electrik ops (campaigns.quickbrownfox.io + SES).
 * Loads LISTMONK_* from www.electrik.dev/.env
 *
 * Usage:
 *   node marketing/ops/listmonk.cjs ping
 *   node marketing/ops/listmonk.cjs lists
 *   node marketing/ops/listmonk.cjs count
 *   node marketing/ops/listmonk.cjs draft-pricing     # create pricing launch draft
 *   node marketing/ops/listmonk.cjs sync-pricing <id> # update draft body to frozen $99/$149
 *   node marketing/ops/listmonk.cjs start <id>        # start a draft campaign (send)
 */
const fs = require('fs');
const path = require('path');
const https = require('https');
const { URL } = require('url');

const ROOT = path.resolve(__dirname, '../..');
const ENV_PATH = path.join(ROOT, '.env');

function loadEnv() {
  if (!fs.existsSync(ENV_PATH)) throw new Error('Missing .env at ' + ENV_PATH);
  const env = {};
  for (const line of fs.readFileSync(ENV_PATH, 'utf8').split('\n')) {
    const m = line.match(/^([A-Z0-9_]+)=(.*)$/);
    if (m) env[m[1]] = m[2].replace(/^["']|["']$/g, '');
  }
  const url = (env.LISTMONK_URL || process.env.LISTMONK_URL || '').replace(/\/$/, '');
  const user = env.LISTMONK_API_USER || process.env.LISTMONK_API_USER;
  const token = env.LISTMONK_API_TOKEN || process.env.LISTMONK_API_TOKEN;
  const listId = Number(env.LISTMONK_LIST_ID || process.env.LISTMONK_LIST_ID || 0);
  const templateId = Number(env.LISTMONK_TEMPLATE_ID || process.env.LISTMONK_TEMPLATE_ID || 9);
  if (!url || !user || !token) {
    throw new Error('LISTMONK_URL / LISTMONK_API_USER / LISTMONK_API_TOKEN required in .env');
  }
  return { url, user, token, listId, templateId };
}

function api(method, apiPath, body) {
  const { url, user, token } = loadEnv();
  const u = new URL(url + apiPath);
  const payload = body ? JSON.stringify(body) : null;
  const auth = Buffer.from(`${user}:${token}`).toString('base64');

  return new Promise((resolve, reject) => {
    const req = https.request(
      {
        hostname: u.hostname,
        path: u.pathname + u.search,
        port: u.port || 443,
        method,
        headers: {
          Authorization: `Basic ${auth}`,
          Accept: 'application/json',
          'Content-Type': 'application/json',
          ...(payload ? { 'Content-Length': Buffer.byteLength(payload) } : {}),
        },
      },
      (res) => {
        let d = '';
        res.on('data', (c) => (d += c));
        res.on('end', () => {
          let json = null;
          try {
            json = d ? JSON.parse(d) : null;
          } catch {
            json = { raw: d };
          }
          if (res.statusCode >= 400) {
            const err = new Error(json?.message || `HTTP ${res.statusCode}`);
            err.status = res.statusCode;
            err.body = json;
            reject(err);
          } else resolve(json);
        });
      },
    );
    req.on('error', reject);
    if (payload) req.write(payload);
    req.end();
  });
}

async function ping() {
  const { listId, templateId, url } = loadEnv();
  const lists = await api('GET', '/api/lists?page=1&per_page=50');
  const electrik = (lists.data?.results || []).find((l) => l.id === listId);
  console.log(
    JSON.stringify(
      {
        url,
        list_id: listId,
        list_name: electrik?.name || null,
        subscribers: electrik?.subscriber_count ?? null,
        template_id: templateId,
      },
      null,
      2,
    ),
  );
}

async function lists() {
  const r = await api('GET', '/api/lists?page=1&per_page=100');
  for (const l of r.data?.results || []) {
    console.log(`${l.id}\t${l.name}\ttype=${l.type}\tsubs=${l.subscriber_count}`);
  }
}

async function count() {
  const { listId } = loadEnv();
  if (!listId) throw new Error('LISTMONK_LIST_ID not set');
  const r = await api('GET', `/api/lists/${listId}`);
  console.log(JSON.stringify({ list_id: listId, name: r.data?.name, subscribers: r.data?.subscriber_count }, null, 2));
}

function pricingBodies() {
  const body = `
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.6;color:#44403c;">
  Hey,
</p>
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.6;color:#44403c;">
  Quick update: Solo and Studio commercial licenses are available at
  <a href="https://electrik.dev/pricing" style="color:#1c1917;">electrik.dev/pricing</a>.
</p>
<ul style="margin:0 0 20px;padding-left:20px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.6;color:#44403c;">
  <li>Grant stays $0 for personal / OSS / pre-revenue indie</li>
  <li>Solo $99 / Studio $149 (one-time)</li>
  <li>Checkout emails a receipt / certificate ID. No product activation key.</li>
</ul>
<p style="margin:0 0 8px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:11px;line-height:1.4;letter-spacing:0.06em;text-transform:uppercase;color:#a8a29e;">
  A note from Neeraj
</p>
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.6;color:#44403c;">
  I built Electrik as the Laravel SaaS kit I wanted for real products: auth, teams, Stripe on the team, and Slate UI, shipped as a Composer package instead of a scaffold dump.
  Commercial checkout is live so companies and studios can license cleanly when the grant does not cover them.
  If something is unclear, reply to this email. I read them.
</p>
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.6;color:#44403c;">
  Demo: <a href="https://demo.electrik.dev" style="color:#1c1917;">demo.electrik.dev</a> /
  Install: <a href="https://electrik.dev/install" style="color:#1c1917;">electrik.dev/install</a>
</p>
<p style="margin:0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.6;color:#78716c;">
  - Neeraj
</p>
`.trim();

  const altbody = `Hey,

Quick update: Solo and Studio commercial licenses are available at https://electrik.dev/pricing

- Grant stays $0 for personal / OSS / pre-revenue indie
- Solo $99 / Studio $149 (one-time)
- Checkout emails a receipt / certificate ID. No product activation key.

A note from Neeraj

I built Electrik as the Laravel SaaS kit I wanted for real products: auth, teams, Stripe on the team, and Slate UI, shipped as a Composer package instead of a scaffold dump. Commercial checkout is live so companies and studios can license cleanly when the grant does not cover them. If something is unclear, reply to this email. I read them.

Demo: https://demo.electrik.dev / Install: https://electrik.dev/install

- Neeraj`;

  return { body, altbody };
}

async function draftPricing() {
  const { listId, templateId } = loadEnv();
  if (!listId) throw new Error('LISTMONK_LIST_ID not set');
  const { body, altbody } = pricingBodies();
  const created = await api('POST', '/api/campaigns', {
    name: 'Electrik commercial licenses live',
    subject: 'Electrik commercial licenses are live',
    lists: [listId],
    from_email: 'Electrik <hello@electrik.dev>',
    type: 'regular',
    content_type: 'html',
    body,
    altbody,
    messenger: 'email',
    template_id: templateId,
    tags: ['electrik', 'pricing'],
  });
  console.log(
    JSON.stringify(
      {
        id: created.data?.id,
        status: created.data?.status || 'draft',
        list_id: listId,
        admin: `https://campaigns.quickbrownfox.io/admin/campaigns/${created.data?.id}`,
      },
      null,
      2,
    ),
  );
}

async function syncPricing(id) {
  if (!id) throw new Error('Usage: listmonk.cjs sync-pricing <campaign_id>');
  const { listId, templateId } = loadEnv();
  const existing = await api('GET', `/api/campaigns/${id}`);
  const c = existing.data;
  if (!c) throw new Error('Campaign not found: ' + id);
  if (c.status !== 'draft') throw new Error(`Refuse sync: status is ${c.status}, need draft`);
  const { body, altbody } = pricingBodies();
  const updated = await api('PUT', `/api/campaigns/${id}`, {
    name: c.name,
    subject: 'Electrik commercial licenses are live',
    lists: (c.lists || []).map((l) => l.id).filter(Boolean).length
      ? (c.lists || []).map((l) => l.id).filter(Boolean)
      : [listId],
    from_email: c.from_email || 'Electrik <hello@electrik.dev>',
    type: c.type || 'regular',
    content_type: c.content_type || 'html',
    body,
    altbody,
    messenger: c.messenger || 'email',
    template_id: c.template_id || templateId,
    tags: c.tags || ['electrik', 'pricing'],
  });
  console.log(
    JSON.stringify(
      {
        id: Number(id),
        status: updated.data?.status || c.status,
        subject: 'Electrik commercial licenses are live',
        prices: 'Solo $99 / Studio $149',
        admin: `https://campaigns.quickbrownfox.io/admin/campaigns/${id}`,
      },
      null,
      2,
    ),
  );
}

async function start(id) {
  if (!id) throw new Error('Usage: listmonk.cjs start <campaign_id>');
  const r = await api('PUT', `/api/campaigns/${id}/status`, { status: 'running' });
  console.log(JSON.stringify({ id, status: r.data?.status || 'running' }, null, 2));
}

async function main() {
  const cmd = process.argv[2] || 'ping';
  if (cmd === 'ping') await ping();
  else if (cmd === 'lists') await lists();
  else if (cmd === 'count') await count();
  else if (cmd === 'draft-pricing') await draftPricing();
  else if (cmd === 'sync-pricing') await syncPricing(process.argv[3]);
  else if (cmd === 'start') await start(process.argv[3]);
  else {
    console.error('Unknown command:', cmd);
    process.exit(1);
  }
}

main().catch((e) => {
  console.error('Error:', e.message);
  if (e.body) console.error(JSON.stringify(e.body, null, 2));
  process.exit(1);
});
