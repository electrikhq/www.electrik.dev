#!/usr/bin/env node
/**
 * Resend helper for Electrik ops (updates.electrik.dev).
 * Loads RESEND_KEY / RESEND_FROM from www.electrik.dev/.env
 *
 * Usage:
 *   node marketing/ops/resend.cjs ping
 *   node marketing/ops/resend.cjs domains
 *   node marketing/ops/resend.cjs send --to a@b.com --subject "..." --text "..." [--reply-to hello@electrik.dev]
 */
const fs = require('fs');
const path = require('path');
const ROOT = path.resolve(__dirname, '../..');
const ENV_PATH = path.join(ROOT, '.env');

function loadEnv() {
  const env = {};
  for (const line of fs.readFileSync(ENV_PATH, 'utf8').split('\n')) {
    const m = line.match(/^([A-Z0-9_]+)=(.*)$/);
    if (m) env[m[1]] = m[2].replace(/^["']|["']$/g, '');
  }
  if (!env.RESEND_KEY) throw new Error('RESEND_KEY missing in .env');
  return env;
}

async function api(method, p, body, key) {
  const res = await fetch('https://api.resend.com' + p, {
    method,
    headers: {
      Authorization: 'Bearer ' + key,
      'Content-Type': 'application/json',
    },
    body: body ? JSON.stringify(body) : undefined,
  });
  const text = await res.text();
  let json; try { json = JSON.parse(text); } catch { json = { raw: text }; }
  if (!res.ok) {
    const err = new Error(JSON.stringify(json));
    err.status = res.status;
    throw err;
  }
  return json;
}

function arg(name, fallback) {
  const i = process.argv.indexOf(name);
  if (i === -1) return fallback;
  return process.argv[i + 1];
}

async function main() {
  const cmd = process.argv[2] || 'ping';
  const env = loadEnv();
  if (cmd === 'ping' || cmd === 'domains') {
    const j = await api('GET', '/domains', null, env.RESEND_KEY);
    console.log(JSON.stringify(j, null, 2));
    return;
  }
  if (cmd === 'send') {
    const to = arg('--to');
    const subject = arg('--subject');
    const text = arg('--text');
    const replyTo = arg('--reply-to', 'hello@electrik.dev');
    const from = arg('--from', env.RESEND_FROM || 'Electrik <hello@updates.electrik.dev>');
    if (!to || !subject || !text) throw new Error('need --to --subject --text');
    const j = await api('POST', '/emails', {
      from,
      to: [to],
      reply_to: replyTo,
      subject,
      text,
    }, env.RESEND_KEY);
    console.log(JSON.stringify(j, null, 2));
    return;
  }
  throw new Error('unknown command ' + cmd);
}

main().catch((e) => { console.error(e.message || e); process.exit(1); });
