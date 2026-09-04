# Content queue

Ship one per week. Move done items to “Shipped”.

## Ready / next

1. **Electrik vs Jetstream (share)** — https://electrik.dev/compare/electrik-vs-jetstream  
2. **Install video thread** — Clipy already live; amplify week 2  
3. **Teams + Stripe on the team** — docs deep-link + screenshot  
4. **Laracasts / r/laravel** — Composer-package post (draft below; update prices)  
5. **[~] Install Loom (60s)** — superseded by Clipy; keep file as backup  

### X — licenses live (SHIPPED)

https://x.com/electrikhq/status/2095807473953505626

```
Commercial licenses for Electrik are live.

$0 Additional Use Grant — personal / OSS / pre-revenue indie
Solo $99 · Studio $149 · Agency custom (one-time)

Same full kit either way — auth, teams, Stripe on the team, Slate UI.
Composer package, not a scaffold dump. Checkout → license email.

Demo: https://demo.electrik.dev
Pricing: https://electrik.dev/pricing
Install: https://electrik.dev/install
```

### X — 60s / 2‑min install (Clipy)

```
Electrik in ~2 minutes:

composer require electrik/electrik
→ Livewire dashboard
→ teams
→ Stripe on the team

Laravel SaaS as a package, not a scaffold dump.

Walkthrough: https://clipy.online/video/5rpdlm7ajzs5
Install: https://electrik.dev/install
Demo: https://demo.electrik.dev
```

## Drafts

### LinkedIn — commercial pricing (when company page exists)

```
Electrik commercial licenses are live.

Laravel SaaS starter as a Composer package (not a scaffold dump): teams + Stripe billing on the team + Slate UI.

Honest dual lane:
• $0 grant — personal, OSS, pre-revenue indie
• Solo $99 / Studio $149 — companies and client work
• Agency — custom

Checkout: https://electrik.dev/pricing
```

### Listmonk broadcast (SHIPPED 2026-09-04)

**Campaign ID:** `18` · status **finished** · **79 sent** · list Electrik `#11`  
**Admin:** https://campaigns.quickbrownfox.io/admin/campaigns/18  
**From:** `Electrik <hello@electrik.dev>` · prices Solo $99 / Studio $149

### X / LinkedIn — Jetstream compare (ready)

```
Electrik vs Jetstream, short version:

Jetstream = official auth/teams scaffold. You own every file. No Stripe billing.

Electrik = Composer package with teams + Stripe on the team + Slate UI. BSL grant for indies; Solo/Studio when you need commercial.

Matrix + “when to pick each”:
https://electrik.dev/compare/electrik-vs-jetstream
```

### Laracasts / r/laravel (week 4)

**Title:** Why we ship Electrik as a Composer package (Laravel 12 SaaS starter)

**Body:**
```
Most Laravel SaaS kits copy auth, billing, and teams into your `app/` folder. You own the merge pain on every upstream update.

Electrik 5.x stays in the `Electrik\` namespace: `composer require electrik/electrik`, `php artisan electrik:install`, customize via config and published views. Teams + Stripe Cashier on the team + Spatie permissions + Slate 3 UI.

Still early. APIs can still evolve in minors. But the model is intentional: package-first, not scaffold-and-fork.

- Demo: https://demo.electrik.dev
- Install: https://electrik.dev/install
- Pricing: Grant $0 · Solo $99 · Studio $149 · Agency custom
- License: BSL with a free indie grant; commercial for companies/agencies
- UI: https://slate.electrik.dev (Slate + slate-blocks)

Happy to answer install questions.
```

## Shipped

- 2026-09-04 — Licenses-live X @electrikhq — https://x.com/electrikhq/status/2095807473953505626
- 2026-09-04 — Homepage conversion reorder live; content queue prices corrected to $99/$149
- 2026-08-24 — Slate→Electrik bridge (slate homepage CTA, docs, `/install` callout, READMEs) — pushed all repos
- 2026-08-24 — GitHub Release `v5.0.0-alpha.15` + demoted ancient `0.0.13` — https://github.com/electrikhq/electrik/releases/tag/v5.0.0-alpha.15
- 2026-08-24 — Mailchimp re-engagement (API) — campaign `0fb6a8a24a` → then **Mailchimp account blocked**; await Brevo
- 2026-08-24 — Product Hunt listing fields (tagline + description + website) — https://www.producthunt.com/products/electrik
- 2026-08-24 — X post (Composer package / 5.x) — https://x.com/electrikhq
- 2026-08-24 — Future Tools directory submit — https://futuretools.io/submit-a-tool (pending review)
