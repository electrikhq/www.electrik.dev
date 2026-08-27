# Stripe Payment Links + outbound mail (www / demo)

## Solo / Studio Checkout (www — static site)

electrik.dev is statically exported, so commercial Checkout uses **Stripe Payment Links** (no live PHP required).

### Setup

1. Stripe Dashboard → **Product catalog** → create one-time products:
   - Electrik Solo — $249
   - Electrik Studio — $599
2. **Payment links** → create a link per product.
3. After payment, set redirect to:
   - Solo: `https://electrik.dev/pricing/thanks?tier=solo`
   - Studio: `https://electrik.dev/pricing/thanks?tier=studio`
4. Put the Payment Link URLs in deploy env (or Cloudflare Pages env for build):

```bash
STRIPE_CHECKOUT_SOLO=https://buy.stripe.com/...
STRIPE_CHECKOUT_STUDIO=https://buy.stripe.com/...
```

5. Rebuild/export www so `config('site.commercial_tiers.*.checkout_url')` is non-empty.
   Pricing CTAs become **Buy with Stripe**; without env they stay mailto.

Agency stays contact/sales (custom).

### Ops after a sale

- Stripe email confirms payment.
- Manually send license certificate from `hello@electrik.dev` (or automate later with a webhook worker).

## Resend / SES (demo transactional)

Public demo can use **SES** with abuse controls in `demo.electrik.dev/overlay/` (rate limits, optional Turnstile, daily send cap). Verification stays off.

See `demo.electrik.dev/shared.env.example` and `DEPLOY.md`. Do **not** put SES keys in the Electrik package repo.
