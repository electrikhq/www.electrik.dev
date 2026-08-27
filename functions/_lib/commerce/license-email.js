import { TIER_LABELS } from './catalog.js';

/**
 * Commercial license confirmation (HTML + text).
 * Electrik does not use activation keys — certificate ID is a receipt reference.
 */
export function renderLicenseEmail(purchase) {
  const tierLabel = TIER_LABELS[purchase.tier] || TIER_LABELS.unknown;
  const name = purchase.name ? String(purchase.name).trim() : '';
  const greeting = name ? `Hi ${escapeHtml(name)},` : 'Hi,';
  const greetingText = name ? `Hi ${name},` : 'Hi,';
  const hasCert = Boolean(purchase.license_key);
  const cert = hasCert ? String(purchase.license_key) : '';
  const paymentId = String(purchase.payment_id || '');
  const tier = String(purchase.tier || 'unknown');

  const subject = hasCert
    ? `Your ${tierLabel} commercial license`
    : `We received your ${tierLabel} payment`;

  const text = [
    greetingText,
    '',
    hasCert
      ? `Thanks for purchasing ${tierLabel}. You are licensed for commercial use under this tier.`
      : `Thanks for purchasing ${tierLabel}. Your payment is confirmed; your license confirmation will follow shortly.`,
    '',
    'Electrik does not require a product activation key — Composer install works as usual. Keep this email as your receipt.',
    '',
    hasCert ? `Certificate ID: ${cert}` : '',
    `Payment ID: ${paymentId}`,
    `Tier: ${tier}`,
    '',
    'Install: https://electrik.dev/install',
    'Docs: https://electrik.dev/docs',
    'License terms: https://electrik.dev/license',
    '',
    'Questions? Reply to this email or write hello@electrik.dev.',
    '',
    '— Electrik',
  ]
    .filter((line, i, arr) => !(line === '' && arr[i - 1] === ''))
    .join('\n');

  const html = buildHtml({
    greeting,
    tierLabel: escapeHtml(tierLabel),
    hasCert,
    cert: escapeHtml(cert),
    paymentId: escapeHtml(paymentId),
    tier: escapeHtml(tier),
  });

  return { subject, text, html };
}

function buildHtml({ greeting, tierLabel, hasCert, cert, paymentId, tier }) {
  const lead = hasCert
    ? `Thanks for purchasing <strong style="color:#1c1917;">${tierLabel}</strong>. You are licensed for commercial use under this tier.`
    : `Thanks for purchasing <strong style="color:#1c1917;">${tierLabel}</strong>. Your payment is confirmed; your license confirmation will follow shortly.`;

  const certBlock = hasCert
    ? `
                  <tr>
                    <td style="padding:0 0 8px 0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:11px;line-height:1.4;letter-spacing:0.06em;text-transform:uppercase;color:#a8a29e;">
                      Certificate ID
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:0 0 20px 0;">
                      <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#fafaf9;border:1px solid #e7e5e4;border-radius:8px;">
                        <tr>
                          <td style="padding:14px 16px;font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;font-size:13px;line-height:1.5;color:#44403c;word-break:break-all;">
                            ${cert}
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>`
    : '';

  return `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">
  <title>${tierLabel} commercial license</title>
</head>
<body style="margin:0;padding:0;background-color:#f5f5f4;-webkit-text-size-adjust:100%;">
  <div style="display:none;max-height:0;overflow:hidden;mso-hide:all;">
    ${hasCert ? `Your ${tierLabel} commercial license — keep this email as your receipt.` : `We received your ${tierLabel} payment.`}
  </div>
  <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f5f5f4;">
    <tr>
      <td align="center" style="padding:40px 16px;">
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:560px;background-color:#ffffff;border:1px solid #e7e5e4;border-radius:12px;overflow:hidden;">
          <tr>
            <td style="padding:28px 28px 0 28px;">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td valign="middle" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;font-weight:600;letter-spacing:-0.03em;color:#1c1917;">
                    Electrik
                  </td>
                  <td valign="middle" align="right" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:12px;letter-spacing:0.02em;color:#a8a29e;">
                    Commercial license
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:20px 28px 0 28px;">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td style="height:1px;background-color:#e7e5e4;font-size:0;line-height:0;">&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:28px 28px 8px 28px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:22px;font-weight:600;letter-spacing:-0.03em;line-height:1.25;color:#1c1917;">
              ${hasCert ? 'You are licensed' : 'Payment received'}
            </td>
          </tr>
          <tr>
            <td style="padding:0 28px 24px 28px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.65;color:#57534e;">
              <p style="margin:0 0 16px 0;">${greeting}</p>
              <p style="margin:0 0 16px 0;">${lead}</p>
              <p style="margin:0;color:#a8a29e;font-size:14px;">
                No product activation key is required — Composer install works as usual. Keep this email as your receipt.
              </p>
            </td>
          </tr>
          <tr>
            <td style="padding:0 28px 8px 28px;">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                ${certBlock}
                <tr>
                  <td style="padding:0 0 6px 0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:11px;line-height:1.4;letter-spacing:0.06em;text-transform:uppercase;color:#a8a29e;">
                    Payment ID
                  </td>
                </tr>
                <tr>
                  <td style="padding:0 0 16px 0;font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;font-size:13px;line-height:1.5;color:#44403c;word-break:break-all;">
                    ${paymentId}
                  </td>
                </tr>
                <tr>
                  <td style="padding:0 0 6px 0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:11px;line-height:1.4;letter-spacing:0.06em;text-transform:uppercase;color:#a8a29e;">
                    Tier
                  </td>
                </tr>
                <tr>
                  <td style="padding:0 0 28px 0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:15px;font-weight:600;color:#1c1917;">
                    ${tierLabel}
                    <span style="font-weight:400;color:#a8a29e;"> · ${tier}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:0 28px 32px 28px;">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="border-radius:8px;background-color:#292524;">
                    <a href="https://electrik.dev/install" style="display:inline-block;padding:12px 18px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;color:#ffffff;text-decoration:none;">
                      Install Electrik
                    </a>
                  </td>
                  <td width="10" style="font-size:0;line-height:0;">&nbsp;</td>
                  <td style="border-radius:8px;border:1px solid #d6d3d1;">
                    <a href="https://electrik.dev/docs" style="display:inline-block;padding:11px 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;color:#44403c;text-decoration:none;">
                      Docs
                    </a>
                  </td>
                  <td width="10" style="font-size:0;line-height:0;">&nbsp;</td>
                  <td style="border-radius:8px;border:1px solid #d6d3d1;">
                    <a href="https://electrik.dev/license" style="display:inline-block;padding:11px 16px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;color:#44403c;text-decoration:none;">
                      License
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:20px 28px;border-top:1px solid #e7e5e4;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.55;color:#78716c;">
              Questions? Reply to this email or write
              <a href="mailto:hello@electrik.dev" style="color:#1c1917;text-decoration:underline;">hello@electrik.dev</a>.
              <br>
              <span style="color:#a8a29e;">— Electrik · electrik.dev</span>
            </td>
          </tr>
        </table>
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:560px;">
          <tr>
            <td style="padding:16px 8px 0 8px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:11px;line-height:1.5;color:#a8a29e;text-align:center;">
              This message confirms a commercial Additional Use Grant. It is not software DRM.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>`;
}

function escapeHtml(value) {
  return String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}
