import { AwsClient } from 'aws4fetch';
import { TIER_LABELS } from './catalog.js';

/**
 * Outbound mail via AWS SES (same stack as demo.electrik.dev).
 * Pages secrets: AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, AWS_DEFAULT_REGION
 * Optional: MAIL_FROM (default hello@electrik.dev / Electrik)
 */
export async function sendLicenseEmail(env, purchase) {
  const to = purchase.email;
  if (!to) {
    return { ok: false, error: 'missing email' };
  }

  const tierLabel = TIER_LABELS[purchase.tier] || TIER_LABELS.unknown;
  const subject = purchase.license_key
    ? `Your ${tierLabel} license`
    : `We received your ${tierLabel} payment`;

  const bodyText = [
    `Hi${purchase.name ? ` ${purchase.name}` : ''},`,
    '',
    purchase.license_key
      ? `Thanks for purchasing ${tierLabel}. Your license key is:`
      : `Thanks for purchasing ${tierLabel}. Your payment is confirmed; your license key will follow shortly.`,
    '',
    purchase.license_key ? purchase.license_key : '',
    '',
    `Payment ID: ${purchase.payment_id}`,
    `Tier: ${purchase.tier}`,
    '',
    'Install: https://electrik.dev/install',
    'Docs: https://electrik.dev/docs',
    '',
    'Questions? Reply to this email or write hello@electrik.dev.',
    '',
    '— Electrik',
  ]
    .filter((line, i, arr) => !(line === '' && arr[i - 1] === ''))
    .join('\n');

  return sendSesEmail(env, {
    to,
    subject,
    text: bodyText,
  });
}

export async function sendOpsAlert(env, subject, text) {
  const to = env.COMMERCE_OPS_EMAIL || 'hello@electrik.dev';
  const result = await sendSesEmail(env, { to, subject, text });
  if (result.skipped) {
    console.log(JSON.stringify({ ops_alert: subject, text }));
  }
  return result;
}

async function sendSesEmail(env, { to, subject, text }) {
  if (!env.AWS_ACCESS_KEY_ID || !env.AWS_SECRET_ACCESS_KEY) {
    return { ok: false, error: 'AWS SES credentials not configured', skipped: true };
  }

  const region = env.AWS_DEFAULT_REGION || 'ap-south-1';
  const fromEmail = env.MAIL_FROM_ADDRESS || 'hello@electrik.dev';
  const fromName = env.MAIL_FROM_NAME || 'Electrik';
  const from = `${fromName} <${fromEmail}>`;

  const aws = new AwsClient({
    accessKeyId: env.AWS_ACCESS_KEY_ID,
    secretAccessKey: env.AWS_SECRET_ACCESS_KEY,
    region,
    service: 'ses',
  });

  // SES API v2 SendEmail
  const res = await aws.fetch(`https://email.${region}.amazonaws.com/v2/email/outbound-emails`, {
    method: 'POST',
    headers: { 'content-type': 'application/json' },
    body: JSON.stringify({
      FromEmailAddress: from,
      Destination: { ToAddresses: [to] },
      Content: {
        Simple: {
          Subject: { Data: subject, Charset: 'UTF-8' },
          Body: { Text: { Data: text, Charset: 'UTF-8' } },
        },
      },
    }),
  });

  const raw = await res.text();
  let data = {};
  try {
    data = raw ? JSON.parse(raw) : {};
  } catch {
    data = { raw };
  }

  if (!res.ok) {
    return {
      ok: false,
      error: data?.message || data?.Message || `SES ${res.status}`,
      provider: 'ses',
    };
  }

  return {
    ok: true,
    provider: 'ses',
    id: data.MessageId || data.messageId || null,
  };
}
