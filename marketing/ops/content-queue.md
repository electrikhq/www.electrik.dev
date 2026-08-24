# Content queue

Ship one per week. Move done items to “Shipped”.

## Ready / next

1. ~~**Composer package vs copy-on-install**~~ → drafted 2026-08-24 (see Drafts)
2. **Teams + Stripe on the team** — docs deep-link + screenshot  
3. **Install Loom (5–8 min)** — fresh Laravel → Electrik → login  
4. **BSL grant vs commercial** — honest dual lane (links `/license` `/pricing`)  
5. **Slate → Electrik** — UI kit fans into SaaS shell  

## Drafts

### X / Twitter (approve to post)

```
Electrik 5.x is a Laravel SaaS starter as a Composer package — not a copy-paste kit.

Teams, Stripe billing on the team, Spatie permissions, Slate 3 UI. Full source.
Free for indies under BSL; commercial license for agencies.

Demo: https://demo.electrik.dev (demo@electrik.dev / password)
Docs: https://electrik.dev/docs
```

### Product Hunt — listing fields (paste in PH admin)

**Tagline:** Laravel SaaS starter kit with teams, Stripe billing, and Slate 3

**Description:**
```
Electrik is a full-featured SaaS starter as a Composer package for Laravel 12. Auth, team workspaces, Stripe subscriptions (Cashier), Spatie permissions, onboarding, and a Slate 3 UI shell — without copy-on-install kits that drift from upstream.

Docs → https://electrik.dev/docs · Demo → https://demo.electrik.dev · GitHub → https://github.com/electrikhq/electrik · UI kit → https://slate.electrik.dev
```

Current live title still shows **“Your Next Big SaaS starts here!”** — update needed.

### Laracasts / r/laravel (longer — week 2 or approve now)

**Title:** Why we ship Electrik as a Composer package (Laravel 12 SaaS starter)

**Body:**
```
Most Laravel SaaS kits copy auth, billing, and teams into your `app/` folder. You own the merge pain on every upstream update.

Electrik 5.x stays in the `Electrik\` namespace: `composer require electrik/electrik`, `php artisan electrik:install`, customize via config and published views. Teams + Stripe Cashier on the team + Spatie permissions + Slate 3 UI.

Still alpha (5.0.0-alpha.14) — APIs can move. But the model is intentional: package-first, not scaffold-and-fork.

- Demo: https://demo.electrik.dev
- Install: https://electrik.dev/install
- License: BSL with a free indie grant; commercial for companies/agencies

Happy to answer install questions.
```

## Shipped

_(date — title — URL)_
