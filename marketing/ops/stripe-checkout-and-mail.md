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

Demo should stay `MAIL_MAILER=log` for throwaway public accounts (see `demo.electrik.dev/shared.env.example`).

When you want real mail (invites, password reset) on a private staging app:

```bash
MAIL_MAILER=resend
RESEND_KEY=re_...
MAIL_FROM_ADDRESS=hello@electrik.dev
MAIL_FROM_NAME=Electrik
```

Or SES via Laravel’s `ses` mailer + AWS keys. Do **not** enable on the public demo without rate limits and abuse controls.
