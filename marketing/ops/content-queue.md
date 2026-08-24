# Content queue

Ship one per week. Move done items to “Shipped”.

## Ready / next

1. **BSL grant vs commercial** — post Solo $249 / Studio $599 / Agency (links `/license` `/pricing`)  
2. **Teams + Stripe on the team** — docs deep-link + screenshot  
3. **Install Loom (5–8 min)** — fresh Laravel → Electrik → login  
4. **Slate → Electrik** — UI kit + slate-blocks into SaaS shell  
5. **Laracasts / r/laravel** — Composer-package post (draft below; week 2)

## Drafts

### Laracasts / r/laravel (week 2)

**Title:** Why we ship Electrik as a Composer package (Laravel 12 SaaS starter)

**Body:**
```
Most Laravel SaaS kits copy auth, billing, and teams into your `app/` folder. You own the merge pain on every upstream update.

Electrik 5.x stays in the `Electrik\` namespace: `composer require electrik/electrik`, `php artisan electrik:install`, customize via config and published views. Teams + Stripe Cashier on the team + Spatie permissions + Slate 3 UI.

Still alpha (5.0.0-alpha.15) — APIs can move. But the model is intentional: package-first, not scaffold-and-fork.

- Demo: https://demo.electrik.dev
- Install: https://electrik.dev/install
- Pricing: Grant $0 · Solo $249 · Studio $599 · Agency custom
- License: BSL with a free indie grant; commercial for companies/agencies
- UI: https://slate.electrik.dev (Slate + slate-blocks)

Happy to answer install questions.
```

## Shipped

- 2026-08-24 — Slate→Electrik bridge (slate homepage CTA, docs, `/install` callout, READMEs) — pushed all repos
- 2026-08-24 — GitHub Release `v5.0.0-alpha.15` + demoted ancient `0.0.13` — https://github.com/electrikhq/electrik/releases/tag/v5.0.0-alpha.15
- 2026-08-24 — Mailchimp re-engagement (API) — campaign `0fb6a8a24a` → then **Mailchimp account blocked**; await Brevo
- 2026-08-24 — Product Hunt listing fields (tagline + description + website) — https://www.producthunt.com/products/electrik
- 2026-08-24 — X post (Composer package / 5.x) — https://x.com/electrikhq
- 2026-08-24 — Future Tools directory submit — https://futuretools.io/submit-a-tool (pending review)
