# Electrik commercial commerce (Dodo + Cloudflare)

Static marketing site (`dist/`) + **Pages Functions** + **D1** ledger.

```
Buy now (static Dodo link)
        │
        ▼
Dodo Checkout (test/live)
        │  webhooks
        ▼
POST https://electrik.dev/api/commerce/webhook
        │  verify signature · idempotent
        ▼
D1 electrik-commerce
  customers · purchases · webhook_events · outbound_emails
        │
        ├─ payment.succeeded / entitlement_grant.delivered
        │     → store certificate ID → SES “commercial license” email
        ├─ payment.failed / cancelled → ops alert
        └─ refund.succeeded / entitlement_grant.revoked → mark revoked
```

## Endpoints

| Method | Path | Auth | Purpose |
|---|---|---|---|
| POST | `/api/commerce/webhook` | Dodo signature | Ingest events |
| GET | `/api/commerce/status?payment_id=` | public | Thanks-page poll (no key leaked) |
| GET | `/api/commerce/admin/purchases` | `Bearer COMMERCE_ADMIN_TOKEN` | Ops list |

## One-time Cloudflare setup

```bash
cd www.electrik.dev
npx wrangler d1 create electrik-commerce
# paste database_id into wrangler.toml → [[d1_databases]].database_id

npx wrangler d1 migrations apply electrik-commerce --remote

# Pages secrets (project name: electrik)
npx wrangler pages secret put DODO_PAYMENTS_WEBHOOK_KEY --project-name=electrik
npx wrangler pages secret put COMMERCE_ADMIN_TOKEN --project-name=electrik
npx wrangler pages secret put AWS_ACCESS_KEY_ID --project-name=electrik
npx wrangler pages secret put AWS_SECRET_ACCESS_KEY --project-name=electrik
npx wrangler pages secret put AWS_DEFAULT_REGION --project-name=electrik   # ap-south-1
npx wrangler pages secret put MAIL_FROM_ADDRESS --project-name=electrik   # hello@electrik.dev
# optional:
npx wrangler pages secret put MAIL_FROM_NAME --project-name=electrik
npx wrangler pages secret put COMMERCE_OPS_EMAIL --project-name=electrik
```

Also set Pages **vars** (or wrangler `[vars]`) for live product IDs:

- `COMMERCE_PRODUCT_SOLO`
- `COMMERCE_PRODUCT_STUDIO`

Bake checkout URLs at build time via GitHub secrets `DODO_CHECKOUT_SOLO` / `DODO_CHECKOUT_STUDIO`
(see `dodo-checkout-and-mail.md`). **Never** put `DODO_PAYMENTS_API_KEY` in Pages.

## Dodo Dashboard webhook

1. Developer → Webhooks → Create  
2. URL: `https://electrik.dev/api/commerce/webhook`  
3. Enable at least:
   - `payment.succeeded`
   - `payment.failed`
   - `payment.processing`
   - `payment.cancelled`
   - `refund.succeeded`
   - `entitlement_grant.created`
   - `entitlement_grant.delivered`
   - `entitlement_grant.revoked`
   - `license_key.created` (legacy bridge)
4. Copy signing secret → `DODO_PAYMENTS_WEBHOOK_KEY`

Use a **separate** webhook endpoint for test vs live (or one endpoint and check `business_id` / env).

## Email

Uses **AWS SES** (same verified `electrik.dev` identity / region as the demo — `ap-south-1`). Dodo still issues a license-key UUID; we email it as a **certificate / receipt ID** only — Electrik does not activate or validate keys in the package. Confirmation is **HTML + plain-text** (`functions/_lib/commerce/license-email.js`); local previews under `marketing/ops/previews/`. Confirmation also fires on `entitlement_grant.delivered`.

Without SES credentials on Pages, the ledger still updates; outbound mail is skipped (logged).

## Admin

```bash
curl -s -H "Authorization: Bearer $COMMERCE_ADMIN_TOKEN" \
  'https://electrik.dev/api/commerce/admin/purchases?limit=20'
```

## Local test flow

1. Static Buy links in `.env` (test checkout) — already documented in `dodo-checkout-and-mail.md`
2. For webhooks locally: `npx wrangler pages dev dist --d1 DB=…` **or** use Dodo’s webhook test / `cloudflared` tunnel to a deployed preview
3. Complete test card `4242…4242`
4. Confirm D1 row + SES mail + `/pricing/thanks?payment_id=pay_…`

## What we intentionally do not build

- Customer billing portal (use Dodo dashboard / their emails)
- In-app Cashier replacement inside `electrik/electrik` (separate product concern)
- Trusting the browser redirect alone (thanks page is UX; webhook is source of truth)
