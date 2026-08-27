import { AwsClient } from 'aws4fetch';
import { renderLicenseEmail } from './license-email.js';

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

  const { subject, text, html } = renderLicenseEmail(purchase);

  return sendSesEmail(env, {
    to,
    subject,
    text,
    html,
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

async function sendSesEmail(env, { to, subject, text, html }) {
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

  const body = {
    Text: { Data: text, Charset: 'UTF-8' },
  };
  if (html) {
    body.Html = { Data: html, Charset: 'UTF-8' };
  }

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
          Body: body,
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
