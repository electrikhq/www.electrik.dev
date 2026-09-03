# Homepage redo brief — Electrik

**Status:** implemented (homepage blade + features config)  
**Goal:** convert curiosity → demo/install → paid license toward ~$2k/mo  
**Method:** steal the *system* from ShipFast / Larafast / Supastarter — not gradients, purple, countdown timers, or “8400 makers” cosplay.

Live money path and CTAs already partially shipped (Demo primary, who-is-this-for, $99/$149). This brief is the **full section reorder + copy outline** for one focused homepage pass.

---

## Steal the system (not the look)

| Pattern that works | Electrik version |
| --- | --- |
| One promise in the hero | Composer SaaS kit: teams + billing + Slate — not “launch in days” |
| Show the product fast | Demo CTA + real dashboard shot / short video (already have Clipy) |
| Price early | “From $0 grant · commercial from $99” in hero, not buried |
| Pain → easier way | “Scaffold + Jetstream + Spark + theme” → one `composer require` |
| Feature proof short | 6–8 outcomes max; deep list stays on docs/compare |
| Hard Buy repeating | Pricing / Buy after proof; grant path stays honest |
| Social proof | Demo, Packagist, GitHub, PH, install video — no fake MRR quotes |
| FAQ + final CTA | Keep; studio hire CTA stays **secondary** (footer/end) |

**Do not copy:** Marc Lou founder essay length, fake urgency (“13 left”), emoji walls, neon/purple SaaS template look, “AI tool” framing, Discord-as-product.

**Keep Electrik different:** package-in-vendor (not dump repo), BSL dual license honesty, team-as-billing customer, Slate-first UI.

---

## Current → proposed section order

### Today (approx.)
1. Hero + dashboard image  
2. Who is this for  
3. What’s in the package (long list)  
4. Ecosystem (Electrik / Slate / demo)  
5. Built on tools + onboarding image  
6. License lanes ($0 / Paid)  
7. Compare teaser  
8. PH review · newsletter · FAQ · studio CTA  

### Proposed (conversion order)
1. **Hero** (promise + CTAs + price line + proof links)  
2. **Product proof** (screenshot / 2‑min video — same band as hero, not a second essay)  
3. **Pain → Electrik** (hours of stack glue → one package)  
4. **Who is this for** (3 lanes → Install / Solo / Studio)  
5. **What you get** (tight outcome grid, not encyclopedia)  
6. **How install works** (3 steps + video + `composer require`)  
7. **Pricing lanes** (Grant $0 · Solo $99 · Studio $149 · Agency) + Buy/Pricing CTA  
8. **Trust / stack** (Laravel 12, Livewire, Cashier, vendor-resident — short)  
9. **Compare** (links only; matrices stay on `/compare`)  
10. **FAQ** (homepage subset)  
11. **Final CTA** (Demo | Pricing | Install)  
12. **Studio hire** (demoted: one line or keep block but *after* product CTA)

**Demote / cut from mid-page:** ecosystem three-card grid (move under trust or footer strip). Newsletter can stay before final FAQ or after final CTA.

---

## Section briefs + copy outline

### 1. Hero
**Job:** 10-second understand + one next click.

- **Badge:** `5.x · Laravel 12 + Slate 3` (keep version honest)
- **H1 options** (pick one; brand “Electrik” must still win visually in nav/logo):
  - A: `Ship Laravel SaaS with teams, Stripe, and a real UI kit`
  - B: `The Composer package for Laravel SaaS — teams, billing, Slate`
  - C: `Auth, teams, billing, and UI — one package, not a scaffold dump`
- **Sub:** 2 sentences max.  
  `Electrik is a Composer package: auth, team workspaces, Stripe subscriptions, onboarding, and Slate 3. Full features in source. $0 grant for indie/OSS; commercial licenses from $99.`
- **Primary CTA:** Try the demo  
- **Secondary CTA:** Install guide  
- **Tertiary (text):** Pricing — from $0 · commercial from $99  
- **Proof row:** `composer require electrik/electrik` · 2‑min video · GitHub  
- **Avoid in hero:** feature laundry list, ecosystem pitch, hire-us, compare buttons

### 2. Product proof (same viewport band or immediately under)
**Job:** “this is real software.”

- Keep dashboard image **or** replace with looping short clip / Clipy embed if stronger.
- Caption (optional, one line): `Team dashboard · billing · onboarding — live in the demo`
- No floating badges / promo stickers on the image.

### 3. Pain → Electrik
**Job:** ShipFast-style math, Electrik-specific.

**Headline:** `Stop gluing Jetstream, Spark, and a theme together`  
**Sub:** `Most Laravel SaaS starts as four weekends of the same setup. Electrik is the setup.`

| Without Electrik (left) | With Electrik (right) |
| --- | --- |
| Jetstream or Breeze auth | Auth + sessions + profile |
| Hand-roll teams / roles | Team workspaces + roles |
| Spark or DIY Cashier | Team Stripe customer + subscribe/webhooks |
| Random admin UI | Slate 3 components in the kit |
| Copy-paste starter repo | `composer require` — code stays in vendor |

**CTA under section:** Try the demo (secondary: Install)

### 4. Who is this for
**Job:** Route intent (already partly live — keep, tighten copy).

| Lane | Line | CTA |
| --- | --- | --- |
| Learning / side project | Personal, OSS, pre-revenue → $0 grant | Install free → |
| Shipping one product | Company / commercial product → Solo $99 | Buy Solo / Pricing → |
| Studio or agency | Multiple products → Studio $149 / Agency | See Studio → |

Keep: “Not sure? Click through the live demo first.”

### 5. What you get
**Job:** Outcomes, not a catalog.

**Headline:** `What’s in the package`  
**Sub:** `Full SaaS shell in Composer — not a feature-gated free tier.`

Max **8** bullets (rewrite from `config('site.features')` if needed):

1. Email auth, verification, password reset, profile  
2. Teams: create, switch, invite, roles  
3. Stripe: team billing, plans, webhooks, customer portal  
4. Onboarding wizard  
5. Slate 3 UI kit (forms, shell, dark mode)  
6. Notifications + activity log  
7. 2FA  
8. Install stays in vendor — update via Composer  

Link: `Full feature notes →` docs or compare — not more homepage bullets.

### 6. How install works
**Job:** Reduce fear; use the Clipy you already shipped.

**Headline:** `Install in minutes`  
**Steps:**
1. `composer require electrik/electrik`  
2. Run the install / publish steps in the guide  
3. Open the app — teams and billing shell ready to configure  

Embed or link **2‑min video** here (primary proof of DX).  
Secondary link: full `/install`.

### 7. Pricing lanes (on homepage)
**Job:** Make money visible without replacing `/pricing`.

**Headline:** `One feature surface. Two license lanes.`  
**Sub:** Keep honest BSL copy (no “free for companies”).

| Lane | Price | One line | CTA |
| --- | --- | --- | --- |
| Grant | $0 | Indie, school, OSS, pre-revenue | Install |
| Solo | $99 one-time | One commercial product | Buy on Pricing |
| Studio | $149 one-time | Unlimited projects | Buy on Pricing |
| Agency | Custom | Org / white-label needs | Contact |

**Primary button:** Commercial pricing from $99  
**Microcopy under Buy:** `Same install either way. License email after payment — we don’t unlock a secret Pro build.`

### 8. Trust / stack (short)
**Headline:** `Built on tools you already use`  
Keep Laravel 12, Livewire 4, Tailwind v4, Cashier, Spatie Permission, Slate 3.  
One differentiator line: code stays in `vendor/Electrik`.  
Optional: one onboarding screenshot here (moved from current mid-page).  
**Drop** long ecosystem three-column as a peer of Electrik — one footer line: `Also: Slate UI · Demo · Docs`.

### 9. Compare teaser
**Headline:** `Electrik vs Jetstream, Spark, and peers`  
Buttons only → `/compare/jetstream`, Spark, all. No matrix on homepage.

### 10–12. FAQ · Final product CTA · Studio
- FAQ: keep homepage subset; link All FAQs.  
- **Final product CTA (new/replace current studio-first block):**  
  - Title: `Ready to try Electrik?`  
  - Primary: Try the demo · Secondary: Pricing · Tertiary text: Install  
- Studio hire: keep after that, softer: `Need a team to build on this stack?` → Contact (Quick Brown Fox). Product stays hero; hire is last.

---

## CTA rules (whole page)

1. Above the fold: Demo primary, Install secondary, Pricing text.  
2. After proof / pain: Demo again.  
3. After who-is-this-for + pricing lanes: Pricing/Buy for commercial lanes.  
4. Final band: Demo | Pricing | Install — not “Get in touch” as primary.  
5. Nav: Demo, Install, Pricing, Docs/GitHub — Pricing always visible.

---

## Copy voice

- Direct, Laravel-native, no hype revenue claims.  
- Prefer “Composer package” / “vendor” / “team billing” over “boilerplate” / “launch empire.”  
- Never imply MIT or “free for all commercial use.”  
- Never imply Buy unlocks features — it unlocks **legal commercial use**.

---

## Out of scope (this pass)

- Full visual redesign / new brand system  
- New products on homepage  
- Ads, fake scarcity, testimonial farms  
- Rewriting `/pricing` structure (only mirror numbers + “what happens after Buy”)  
- Building features to match Larafast matrix mid-marketing

---

## Implementation checklist

- [x] Reorder sections in `resources/views/pages/home.blade.php`  
- [x] Add Pain → Electrik section (simple two-column list; no card spam)  
- [x] Add Install-in-minutes section with video  
- [x] Tighten feature list to ≤8 outcomes  
- [x] Demote ecosystem grid; keep footer strip  
- [x] Final CTA product-first; studio second  
- [x] Confirm hero/pricing numbers: Grant $0 · Solo $99 · Studio $149  
- [x] Pricing anchors `#solo` / `#studio` for homepage deep links  
- [ ] GA: keep `begin_checkout` on Pricing Buy; homepage Demo/Pricing clicks already via gtag if tagged — add `select_content` only if missing  
- [ ] Mobile: hero still one composition (brand, one H1, one sub, CTA group, one visual) — verify after deploy

---

## Success criteria (2 weeks after ship)

- Higher demo CTR from homepage (GA)  
- Higher `/pricing` → Buy click rate  
- No drop in install guide visits from grant lane  
- Qualitative: stranger can answer “what is it / what do I click / what do I pay” in &lt;10s
