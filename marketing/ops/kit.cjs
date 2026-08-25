#!/usr/bin/env node
/**
 * Kit (ConvertKit) Marketing API v4 helper for Electrik ops.
 * Loads KIT_API_KEY from www.electrik.dev/.env
 *
 * Usage:
 *   node marketing/ops/kit.cjs ping
 *   node marketing/ops/kit.cjs forms
 *   node marketing/ops/kit.cjs tags
 *   node marketing/ops/kit.cjs count
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
  const key = env.KIT_API_KEY || process.env.KIT_API_KEY;
  if (!key) throw new Error('KIT_API_KEY not set in .env');
  return { key, formId: env.KIT_FORM_ID || process.env.KIT_FORM_ID };
}

function api(method, apiPath, body) {
  const { key } = loadEnv();
  const payload = body ? JSON.stringify(body) : null;
  return new Promise((resolve, reject) => {
    const req = https.request(
      {
        hostname: 'api.kit.com',
        path: `/v4${apiPath}`,
        method,
        headers: {
          'X-Kit-Api-Key': key,
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
            const err = new Error(json?.errors?.join?.('; ') || json?.detail || `HTTP ${res.statusCode}`);
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

async function ping() {
  const forms = await api('GET', '/forms?per_page=5');
  const tags = await api('GET', '/tags?per_page=20');
  console.log(JSON.stringify({
    forms: (forms.forms || []).map((f) => ({ id: f.id, name: f.name, uid: f.uid })),
    tags: (tags.tags || []).map((t) => ({ id: t.id, name: t.name })),
  }, null, 2));
}

async function forms() {
  const r = await api('GET', '/forms');
  for (const f of r.forms || []) {
    console.log(`${f.id}\t${f.name}\tuid=${f.uid}\tembed=${f.embed_url}`);
  }
}

async function tags() {
  const r = await api('GET', '/tags');
  for (const t of r.tags || []) {
    console.log(`${t.id}\t${t.name}`);
  }
}

async function count() {
  let total = 0;
  let cursor = null;
  let pages = 0;
  do {
    const q = cursor ? `?per_page=500&after=${encodeURIComponent(cursor)}` : '?per_page=500';
    const r = await api('GET', `/subscribers${q}`);
    total += (r.subscribers || []).length;
    pages += 1;
    cursor = r.pagination?.has_next_page ? r.pagination.end_cursor : null;
  } while (cursor && pages < 50);
  console.log(JSON.stringify({ subscribers: total, pages }));
}

async function main() {
  const cmd = process.argv[2] || 'ping';
  if (cmd === 'ping') await ping();
  else if (cmd === 'forms') await forms();
  else if (cmd === 'tags') await tags();
  else if (cmd === 'count') await count();
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
