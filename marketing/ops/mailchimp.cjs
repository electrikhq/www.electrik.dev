#!/usr/bin/env node
/**
 * Mailchimp Marketing API helper for Electrik ops.
 * Loads MAILCHIMP_API_KEY + MAILCHIMP_SERVER_PREFIX from www.electrik.dev/.env
 *
 * Usage:
 *   node marketing/ops/mailchimp.js ping
 *   node marketing/ops/mailchimp.js lists
 *   node marketing/ops/mailchimp.js signup-url
 *   node marketing/ops/mailchimp.js send-reengagement [--dry-run]
 */
const fs = require('fs');
const path = require('path');
const https = require('https');

const ROOT = path.resolve(__dirname, '../..');
const ENV_PATH = path.join(ROOT, '.env');

function loadEnv() {
  if (!fs.existsSync(ENV_PATH)) throw new Error('Missing .env at ' + ENV_PATH);
  const env = {};
  for (const line of fs.readFileSync(ENV_PATH, 'utf8').split('\n')) {
    const m = line.match(/^([A-Z0-9_]+)=(.*)$/);
    if (m) env[m[1]] = m[2].replace(/^["']|["']$/g, '');
  }
  const key = env.MAILCHIMP_API_KEY || process.env.MAILCHIMP_API_KEY;
  const dc = env.MAILCHIMP_SERVER_PREFIX || process.env.MAILCHIMP_SERVER_PREFIX || (key && key.split('-').pop());
  if (!key) throw new Error('MAILCHIMP_API_KEY not set in .env');
  return { key, dc };
}

function api(method, apiPath, body) {
  const { key, dc } = loadEnv();
  const payload = body ? JSON.stringify(body) : null;
  return new Promise((resolve, reject) => {
    const req = https.request(
      {
        hostname: `${dc}.api.mailchimp.com`,
        path: `/3.0${apiPath}`,
        method,
        headers: {
          Authorization: 'Basic ' + Buffer.from('any:' + key).toString('base64'),
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
            const err = new Error(json?.detail || json?.title || `HTTP ${res.statusCode}`);
            err.status = res.statusCode;
            err.body = json;
            reject(err);
          } else resolve(json);
        });
      }
    );
    req.on('error', reject);
    if (payload) req.write(payload);
    req.end();
  });
}

const REENGAGEMENT = {
  subject: 'Electrik is back — Laravel 12, Composer package',
  preview: 'Teams, Stripe, Slate 3 — and a real install path again.',
  from_name: 'Electrik',
  reply_to: 'hello@electrik.dev',
  plain: `Hey —

It's been quiet here for a long time. Sorry about that.

Electrik is active again. Version 5.x is a Laravel 12 SaaS starter shipped as a Composer package — not a copy-paste kit that drifts from upstream.

What's in the box:
• Auth, teams, Stripe billing on the team, Spatie permissions
• Slate 3 UI shell
• Full source

License is still dual-lane: free for indies under the BSL grant; commercial if you're an agency or shipping client work.

Try it:
→ Demo: https://demo.electrik.dev  (demo@electrik.dev / password)
→ Install: https://electrik.dev/install
→ Docs: https://electrik.dev/docs

Still alpha — APIs can move — but the package-first model is intentional.

If you're building a SaaS or agency client app on Laravel, just reply to this email. I read them.

— Neeraj
Electrik
https://electrik.dev`,
};

function toHtml(plain) {
  const esc = (s) =>
    s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  const linked = esc(plain).replace(
    /(https?:\/\/[^\s]+)/g,
    '<a href="$1">$1</a>'
  );
  return `<!DOCTYPE html><html><body style="font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #222;">
<pre style="font-family: inherit; white-space: pre-wrap; margin: 0;">${linked}</pre>
</body></html>`;
}

async function ping() {
  const r = await api('GET', '/');
  console.log(JSON.stringify({ email: r.email, account: r.accountname, dc: r.dc }, null, 2));
}

async function lists() {
  const r = await api('GET', '/lists?count=20');
  for (const l of r.lists || []) {
    console.log(`${l.id}\t${l.name}\tsubs=${l.stats.member_count}`);
  }
}

async function signupUrl() {
  const listsRes = await api('GET', '/lists?count=20');
  const list =
    (listsRes.lists || []).find((l) => /electrik/i.test(l.name)) || listsRes.lists?.[0];
  if (!list) throw new Error('No audience found');
  console.log(
    JSON.stringify(
      {
        id: list.id,
        name: list.name,
        double_optin: list.double_optin,
        subscribe_url_short: list.subscribe_url_short,
        subscribe_url_long: list.subscribe_url_long,
      },
      null,
      2
    )
  );
}

async function sendReengagement(dryRun) {
  const listsRes = await api('GET', '/lists?count=20');
  const list = (listsRes.lists || []).find((l) => /electrik/i.test(l.name)) || listsRes.lists?.[0];
  if (!list) throw new Error('No audience found');
  console.log(`Audience: ${list.name} (${list.id}) — ${list.stats.member_count} subscribers`);

  const campaign = await api('POST', '/campaigns', {
    type: 'regular',
    recipients: { list_id: list.id },
    settings: {
      subject_line: REENGAGEMENT.subject,
      preview_text: REENGAGEMENT.preview,
      title: 'Electrik is back — 2026-08',
      from_name: REENGAGEMENT.from_name,
      reply_to: REENGAGEMENT.reply_to,
      auto_footer: true,
      inline_css: true,
    },
  });
  console.log(`Campaign created: ${campaign.id} status=${campaign.status}`);

  await api('PUT', `/campaigns/${campaign.id}/content`, {
    plain_text: REENGAGEMENT.plain,
    html: toHtml(REENGAGEMENT.plain),
  });
  console.log('Content set');

  if (dryRun) {
    console.log('Dry run — not sending. Open in admin to review.');
    console.log(`https://us18.admin.mailchimp.com/campaigns/edit?id=${campaign.id}`);
    return;
  }

  const sent = await api('POST', `/campaigns/${campaign.id}/actions/send`);
  console.log('Send triggered', sent || 'ok');
  const check = await api('GET', `/campaigns/${campaign.id}`);
  console.log(JSON.stringify({ id: check.id, status: check.status, emails_sent: check.emails_sent, send_time: check.send_time }, null, 2));
}

async function main() {
  const cmd = process.argv[2] || 'ping';
  const dry = process.argv.includes('--dry-run');
  if (cmd === 'ping') await ping();
  else if (cmd === 'lists') await lists();
  else if (cmd === 'signup-url') await signupUrl();
  else if (cmd === 'send-reengagement') await sendReengagement(dry);
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
