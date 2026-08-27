# Dodo Payments + outbound mail (www / demo)

## Solo / Studio Checkout (www — static site)

electrik.dev is **statically exported** to Cloudflare Pages. There is no PHP at request time.

So commercial checkout uses **Dodo Static Payment Links** (same idea as Stripe Payment Links):

- URLs are baked into HTML at **build/export** time
- **`DODO_PAYMENTS_API_KEY` must never** go into Cloudflare Pages or the browser
- Use the API key only locally (CLI / agent / MCP) to create products & links in test mode

## How to test locally

1. Ensure `www.electrik.dev/.env` has test-mode static links (already set when products exist):

```env
DODO_PAYMENTS_ENVIRONMENT=test_mode
DODO_CHECKOUT_SOLO=https://test.checkout.dodopayments.com/buy/pdt_…?redirect_url=http%3A%2F%2F127.0.0.1%3A8000%2Fpricing%2Fthanks%3Ftier%3Dsolo
DODO_CHECKOUT_STUDIO=https://test.checkout.dodopayments.com/buy/pdt_…?redirect_url=http%3A%2F%2F127.0.0.1%3A8000%2Fpricing%2Fthanks%3Ftier%3Dstudio
```

2. From `www.electrik.dev`:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

3. Open http://127.0.0.1:8000/pricing → **Buy now** on Solo or Studio.
4. On Dodo checkout use test card **`4242 4242 4242 4242`**, any future expiry, any CVC.
5. You should land on `/pricing/thanks?tier=solo` (or `studio`).
6. Confirm the payment in Dodo Dashboard → **Test mode** → Payments.

Decline card for negative path: `4000 0000 0000 0002`.

### Test product IDs (current test catalog)

| Tier | Product ID | Price |
|---|---|---|
| Solo | `pdt_0NmHrYX3IcvoaxjhR91WX` | $149 |
| Studio | `pdt_0NmHrYaV3qDKofAXKLivl` | $399 |

Static link form:

- Test: `https://test.checkout.dodopayments.com/buy/{product_id}?redirect_url=…`
- Live: `https://checkout.dodopayments.com/buy/{product_id}?redirect_url=…`

Live product IDs are **different** — recreate Solo/Studio in live mode before setting GitHub secrets.

## Robust fulfillment (webhooks + ledger)

Static Buy links only start checkout. Long-term ops live in Pages Functions + D1:

→ [`commerce-worker.md`](commerce-worker.md) — webhook verify, purchase history, license email, admin API, refunds.

### Production (live mode)

1. Recreate the same products + static links in **Live** mode (test IDs do not carry over).
2. Add GitHub secrets on `electrikhq/www.electrik.dev`:

| Secret | Value |
|---|---|
| `DODO_CHECKOUT_SOLO` | Live static payment link |
| `DODO_CHECKOUT_STUDIO` | Live static payment link |

3. Redeploy. Build bakes those URLs into `dist/`. Still **no** live API key in Pages.

Agency stays mailto / contact sales.

### Ops after a sale

- Dodo confirms payment (dashboard + email).
- Manually send license certificate from `hello@electrik.dev` (webhook automation later if needed).

## Demo transactional mail (SES)

Unrelated to license checkout. See `demo.electrik.dev` overlay + `shared.env.example`.
