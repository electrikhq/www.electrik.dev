# Electrik ecosystem roadmap

Working notes for www.electrik.dev marketing. Homepage keeps **three cards**; everything else is either an under-link or a later page.

Last updated: 2026-08-24

## Done (do not re-open)

- [x] **GSC cleanup** — sitemaps resubmitted; redirect / `.md` rows validated in Search Console (2026-08-24)
- [x] **Product Hunt** — Electrik + Slate listings live with founder reviews; site embeds + JSON-LD shipped
- [x] **Demo reliability** — `demo.electrik.dev` on Electrik 5.x; login `demo@electrik.dev` / `password`; Carbon icons + billing wired (Stripe test)
- [x] **B3 directory outreach** — runbook/config ready; execution owned outside this chat (do not re-open here)
- [x] **Content queue** — drafting/posting owned outside this chat (do not re-open here)

## Live on homepage (now)

### Product cards (max 3)

| Item | Role | CTA |
|---|---|---|
| **Electrik** | SaaS starter kit (hero) | Install guide |
| **Slate** | UI kit Electrik ships on | Slate docs |
| **Demo** | Live proof | Open demo |

### Under-strip (not cards)

Docs (`/docs`) · License · GitHub

Also: homepage **studio CTA** + `/contact` for client project inquiries (Quick Brown Fox). Product stays the hero; hire-us is secondary.

Config: `config/site.php` → `ecosystem` + `ecosystem_links` + `studio`.

## Docs hub (shipped)

Markdown docs under `resources/content/docs/` with Slate-like chrome (sidebar, TOC, search, `llms.txt`). Marketing `/install` remains the short quickstart; deep guides live under `/docs`.

## Hierarchy rules

1. Electrik is always the hero product on electrik.dev.
2. Slate is the flagship sibling; deep-link to slate.electrik.dev, do not re-host Slate docs here.
3. Demo is proof, not a fourth product brand.
4. Do not grow the homepage card grid past three until there is a clear fourth that converts.
5. Stack dependencies (Spatie, Cashier, Livewire) are “built on,” not ecosystem products.

## Locked 30-day plan (agent authority — 2026-08-24)

North star: **raise Electrik Packagist installs toward Slate** (today ~4/mo vs ~31/mo) and turn Mailchimp + demo into replies/licenses — not more vanity posts.

### P0 — Convert (this week)

1. [x] **Slate → Electrik bridge** — slate homepage CTA + docs/electrik; Electrik `/install` + docs intro; README one-liners (slate, electrik, slate-blocks)
2. [x] **GitHub Releases** — `v5.0.0-alpha.15` published; ancient `0.0.13` / `v0.0.1` demoted to pre-release + deprecated notes
3. [ ] **Pin** the live X 5.x tweet; delete garbled same-day posts — **blocked**: marketing Chrome CDP down (retry when browser up)
4. [x] **Email list** — Mailchimp **blocked**. **Kit** wired (API + site newsletter). Finish import if count < prior list.

### P1 — Proof (next 1–2 weeks)

5. **Laracasts + r/laravel** — ship the Composer-package draft (content-queue).
6. **5–8 min install Loom** — fresh Laravel → Electrik → login; embed on `/install`.
7. **Directory day-2** — retry AI Valley; 5 more Electrik-only directories via backlink-pilot.
8. **Wire `DEMO_DISPATCH_TOKEN`** so Electrik tags auto-redeploy demo.

### P2 — Money (when install is boring)

9. **Stripe Checkout** for Solo $249 / Studio $599 (prices already public).
10. **Valid SES (or Resend)** for demo transactional mail — last AWS keys failed.
11. **List email #2** (~30 days, on **Brevo** once live) — Teams+Stripe or pricing story; then sunset non-openers.

### Explicit defer

- LinkedIn company page  
- Fourth homepage card  
- Ads / sponsor widgets  
- Cold CTO lists  
- MCP server (skill first is enough)  
- `/ecosystem` page until 5+ real pieces feel solid  

### Role split

| Brand | Job |
|---|---|
| **Electrik** | Hero SaaS shell — all list mail, PH push, Packagist growth |
| **Slate** | Top-of-funnel UI kit — feed Electrik, don’t compete with it |
| **slate-blocks** | Proof of ecosystem depth — gallery + FAQ, not a third brand war |
| **Demo** | Trust — always works on current alpha |

## Next candidates (ship later) — plan

Do these **after** release + secrets + (optional) SES. Order by leverage:

### 1. Agent DX (convert “agent-native” talk into proof)

- [x] Ship a real Cursor skill for Electrik install + Slate component pick.
- Keep `llms.txt` accurate on electrik.dev / slate.electrik.dev.
- MCP optional; only after skill is useful.
- Homepage: under-strip or docs callout first — **not** a fourth card until the skill works end-to-end.
- Optional: publish Packagist for `electrik/slate-blocks` (sites already use GitHub VCS / path CI).

### 2. Commercial lane

- [x] Finalize indie BSL grant vs agency/commercial pricing on `/pricing` + `/license`.
- Prefer pricing/license section over a peer product card.
- Only then revisit a fourth homepage card.
- Next: Stripe Checkout or manual invoice flow for Solo/Studio.

### 3. `/ecosystem` page

- Add when there are 5+ real pieces (cards + links + later items).
- Changelog / roadmap for commercial buyer trust.
- Teamwork as one-line “teams engine,” not a hero peer.

### 4. Package polish (post-alpha stability)

- `electrik:make` generators, passkeys, GDPR exports — after API surface settles.
- Starter templates only after alpha is stable.

### Better as footer / later, not homepage cards

- Theme / white-label pack (agency angle)
- Integrations as they land (Socialite, Stripe Tax, Paddle, etc.)
- Hosted demo tenants (“try billing without your Stripe keys”)
- Case studies / “built with”

### Explicit non-goals for ecosystem marketing

- Ads, sponsor widgets, badges as “products”
- Charge and unrelated lab apps
- SubmitMap
- Treating every Laravel/Spatie dependency as an Electrik product

## Suggested future work

- [x] Keep homepage at 3 cards + under-strip
- [x] When docs grow past install, add a real Docs entry (still under-strip or `/docs`, not a card)
- [ ] Add `/ecosystem` page when there are 5+ real pieces (cards + links + later items)
- [x] Ship Agent DX only after skill/`llms.txt` are useful for install + Slate
- [ ] Mention Teamwork as a one-line “teams engine” on install/docs, not homepage hero row
- [ ] Revisit fourth card only after commercial pricing is public

## Marketing ops (agent-run)

Playbook: [`marketing/MARKETING_OPS.md`](MARKETING_OPS.md)  
State / log: `marketing/ops/`

Cadence: **daily pulse** + **Wednesday weekly deep**. Invoke with “run marketing daily/weekly”.
