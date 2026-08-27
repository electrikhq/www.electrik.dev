#!/usr/bin/env node
/**
 * Generate local HTML previews of the commercial license email.
 * Open license-email.html in a browser to approve before wiring SES.
 *
 *   node marketing/ops/previews/render-license-email.mjs
 */
import { writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const templatePath = join(
  __dirname,
  '../../../functions/_lib/commerce/license-email.js',
);

const { renderLicenseEmail } = await import(pathToFileURL(templatePath).href);

const fulfilled = renderLicenseEmail({
  name: 'Neeraj Kumar',
  tier: 'solo',
  payment_id: 'pay_0NmI47JMULNgPE6nmoCsS',
  license_key: 'd97cd197-7346-43b9-949a-1b82b6a89bef',
});

const pending = renderLicenseEmail({
  name: 'Neeraj Kumar',
  tier: 'studio',
  payment_id: 'pay_pending_example',
  license_key: null,
});

const chromeCss = `
    body { margin: 0; font-family: ui-sans-serif, system-ui, sans-serif; background: #e7e5e4; color: #1c1917; }
    .chrome { max-width: 720px; margin: 0 auto; padding: 24px 16px 48px; }
    .banner { background: #fff; border: 1px solid #d6d3d1; border-radius: 12px; padding: 16px 18px; margin-bottom: 16px; }
    .banner h1 { margin: 0 0 6px; font-size: 16px; letter-spacing: -0.02em; }
    .banner p { margin: 0; font-size: 13px; color: #57534e; line-height: 1.5; }
    .banner code { font-size: 12px; background: #f5f5f4; padding: 1px 5px; border-radius: 4px; }
    .meta { margin-top: 10px; font-size: 12px; color: #78716c; }
    .nav { margin-top: 8px; font-size: 13px; }
    .nav a { color: #1c1917; }
    .frame { background: #fff; border: 1px solid #d6d3d1; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
    .frame-bar { padding: 10px 14px; border-bottom: 1px solid #e7e5e4; font-size: 12px; color: #78716c; }
    .frame-bar strong { color: #1c1917; }
`;

function escape(s) {
  return String(s)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');
}

function writePreview({ file, title, blurb, subject, html, otherHref, otherLabel }) {
  const path = join(__dirname, file);
  writeFileSync(
    path,
    `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>${escape(title)} — Electrik email preview</title>
  <style>${chromeCss}</style>
</head>
<body>
  <div class="chrome">
    <div class="banner">
      <h1>${escape(title)}</h1>
      <p>${escape(blurb)}</p>
      <p class="meta">Subject: <strong>${escape(subject)}</strong> · Local only — production still sends plain text · Source: <code>functions/_lib/commerce/license-email.js</code></p>
      <p class="nav"><a href="${otherHref}">${escape(otherLabel)}</a></p>
    </div>
    <div class="frame">
      <div class="frame-bar">Inbox preview · From: <strong>Electrik &lt;hello@electrik.dev&gt;</strong></div>
      ${html}
    </div>
  </div>
</body>
</html>`,
  );
  return path;
}

const a = writePreview({
  file: 'license-email.html',
  title: 'License email (fulfilled)',
  blurb:
    'Sample Solo purchase with certificate ID. Approve this look before we send HTML via SES.',
  subject: fulfilled.subject,
  html: fulfilled.html,
  otherHref: './license-email-pending.html',
  otherLabel: 'View pending (no certificate yet)',
});

const b = writePreview({
  file: 'license-email-pending.html',
  title: 'License email (pending certificate)',
  blurb: 'Rare path: payment recorded, certificate ID not yet on the purchase row.',
  subject: pending.subject,
  html: pending.html,
  otherHref: './license-email.html',
  otherLabel: 'View fulfilled',
});

console.log('Wrote:');
console.log(' ', a);
console.log(' ', b);
