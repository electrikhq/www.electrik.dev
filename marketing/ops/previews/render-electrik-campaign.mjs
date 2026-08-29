#!/usr/bin/env node
/**
 * Local preview of the Electrik Listmonk campaign chrome + sample body.
 * Does not upload to Listmonk — approve first, then we push the template.
 *
 *   node marketing/ops/previews/render-electrik-campaign.mjs
 *   open marketing/ops/previews/electrik-campaign.html
 */
import { readFileSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const templatePath = join(__dirname, 'electrik-campaign.listmonk.html');
const outPath = join(__dirname, 'electrik-campaign.html');

const sampleContent = `
<p style="margin:0 0 8px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:22px;font-weight:600;letter-spacing:-0.03em;line-height:1.25;color:#1c1917;">
  Commercial licenses are live
</p>
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.65;color:#57534e;">
  Hey,
</p>
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.65;color:#57534e;">
  Solo and Studio commercial licenses are available at
  <a href="https://electrik.dev/pricing" style="color:#1c1917;">electrik.dev/pricing</a>.
</p>
<ul style="margin:0 0 20px;padding-left:20px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.65;color:#57534e;">
  <li>Grant stays <strong style="color:#1c1917;">$0</strong> for personal / OSS / pre-revenue indie</li>
  <li><strong style="color:#1c1917;">Solo $149</strong> / <strong style="color:#1c1917;">Studio $399</strong> (one-time)</li>
  <li>Checkout emails a receipt / certificate ID. No product activation key.</li>
</ul>
<p style="margin:0 0 8px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:11px;line-height:1.4;letter-spacing:0.06em;text-transform:uppercase;color:#a8a29e;">
  A note from Neeraj
</p>
<p style="margin:0 0 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.65;color:#57534e;">
  I built Electrik as the Laravel SaaS kit I wanted for real products: auth, teams, Stripe on the team, and Slate UI, shipped as a Composer package instead of a scaffold dump.
  Commercial checkout is live so companies and studios can license cleanly when the grant does not cover them.
  If something is unclear, reply to this email. I read them.
</p>
<p style="margin:0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.65;color:#57534e;">
  Demo: <a href="https://demo.electrik.dev" style="color:#1c1917;">demo.electrik.dev</a> /
  Install: <a href="https://electrik.dev/install" style="color:#1c1917;">electrik.dev/install</a>
</p>
`.trim();

const raw = readFileSync(templatePath, 'utf8');
// Strip Go comment block for browser preview
const stripped = raw.replace(/\{\{\/\*[\s\S]*?\*\/\}\}\s*/, '');
const filled = stripped
  .replace('{{ template "content" . }}', sampleContent)
  .replaceAll('{{ .UnsubscribeURL }}', '#unsubscribe-preview')
  .replaceAll('{{ .MessageURL }}', '#view-in-browser-preview');

const preview = `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Electrik campaign template (local preview)</title>
  <style>
    body { margin: 0; font-family: ui-sans-serif, system-ui, sans-serif; background: #e7e5e4; color: #1c1917; }
    .chrome { max-width: 720px; margin: 0 auto; padding: 24px 16px 48px; }
    .banner { background: #fff; border: 1px solid #d6d3d1; border-radius: 12px; padding: 16px 18px; margin-bottom: 16px; }
    .banner h1 { margin: 0 0 6px; font-size: 16px; letter-spacing: -0.02em; }
    .banner p { margin: 0; font-size: 13px; color: #57534e; line-height: 1.5; }
    .banner code { font-size: 12px; background: #f5f5f4; padding: 1px 5px; border-radius: 4px; }
    .meta { margin-top: 10px; font-size: 12px; color: #78716c; }
    .frame { background: #fff; border: 1px solid #d6d3d1; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
    .frame-bar { padding: 10px 14px; border-bottom: 1px solid #e7e5e4; font-size: 12px; color: #78716c; }
    .frame-bar strong { color: #1c1917; }
  </style>
</head>
<body>
  <div class="chrome">
    <div class="banner">
      <h1>Electrik campaign template (local)</h1>
      <p>Listmonk chrome + sample “commercial licenses” body. Approve this look before we upload the template to Listmonk. Source: <code>electrik-campaign.listmonk.html</code></p>
      <p class="meta">Subject preview: <strong>Electrik commercial licenses are live</strong> | Not uploaded | Not sent</p>
    </div>
    <div class="frame">
      <div class="frame-bar">Inbox preview | From: <strong>Electrik &lt;hello@electrik.dev&gt;</strong></div>
      ${filled}
    </div>
  </div>
</body>
</html>`;

writeFileSync(outPath, preview);
console.log('Wrote', outPath);
