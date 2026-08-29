# Content queue

Ship one per week. Move done items to “Shipped”.

## Ready / next

1. **Electrik vs Jetstream (share)** — https://electrik.dev/compare/electrik-vs-jetstream  
2. **[~] BSL grant vs commercial** — drafts below (Solo $149 / Studio $399); await publish OK  
3. **Teams + Stripe on the team** — docs deep-link + screenshot  
4. **Install Loom (5–8 min)** — fresh Laravel → Electrik → login  
5. **Slate → Electrik** — UI kit + slate-blocks into SaaS shell  
6. **Laracasts / r/laravel** — Composer-package post (draft below)

## Drafts

### X — commercial pricing live (approve to post)

```
Commercial licenses for Electrik are live.

$0 Additional Use Grant for personal / OSS / pre-revenue indie
Solo $149 · Studio $399 · Agency custom

Same full kit either way — auth, teams, Stripe on the team, Slate UI.
No activation key. Checkout → license email.

https://electrik.dev/pricing
```

### LinkedIn — commercial pricing (when company page exists)

```
Electrik commercial licenses are live.

Laravel SaaS starter as a Composer package (not a scaffold dump): teams + Stripe billing on the team + Slate UI.

Honest dual lane:
• $0 grant — personal, OSS, pre-revenue indie
• Solo $149 / Studio $399 — companies and client work
• Agency — custom

Checkout: https://electrik.dev/pricing
```

### Kit broadcast (DRAFT — do not send until from-address verified)

**Kit draft ID:** `25631260` · status: `draft` · [open in Kit](https://app.kit.com/broadcasts/25631260)

**Blocked on:** verify a sending address in Kit (prefer `hello@electrik.dev` or `neeraj@electrik.dev`). Current default `hello@electrik.com` is pending/unverified — do not send until approved.

**Subject:** Electrik commercial licenses are live

**Body (already in draft):**
```
Hey —

Quick update: Solo and Studio commercial licenses are available at electrik.dev/pricing.

• Grant stays $0 for personal / OSS / pre-revenue indie
• Solo $149 · Studio $399 (one-time)
• Checkout emails a receipt / certificate ID — no product activation key

Same package either way. Demo: demo.electrik.dev · Install: electrik.dev/install

— Neeraj
```

When verified: say **send kit** (or Send in Kit UI).
### X / LinkedIn — Jetstream compare (ready)

```
Electrik vs Jetstream, short version:

Jetstream = official auth/teams scaffold. You own every file. No Stripe billing.

Electrik = Composer package with teams + Stripe on the team + Slate UI. BSL grant for indies; Solo/Studio when you need commercial.

Matrix + “when to pick each”:
https://electrik.dev/compare/electrik-vs-jetstream
```

### Laracasts / r/laravel (week 2)

**Title:** Why we ship Electrik as a Composer package (Laravel 12 SaaS starter)

**Body:**
```
Most Laravel SaaS kits copy auth, billing, and teams into your `app/` folder. You own the merge pain on every upstream update.

Electrik 5.x stays in the `Electrik\` namespace: `composer require electrik/electrik`, `php artisan electrik:install`, customize via config and published views. Teams + Stripe Cashier on the team + Spatie permissions + Slate 3 UI.

Still 5.0.0 stable. APIs can still evolve in minors. But the model is intentional: package-first, not scaffold-and-fork.

- Demo: https://demo.electrik.dev
- Install: https://electrik.dev/install
- Pricing: Grant $0 · Solo $149 · Studio $399 · Agency custom
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
