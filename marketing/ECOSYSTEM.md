# Electrik ecosystem roadmap

Working notes for www.electrik.dev marketing. Homepage keeps **three cards**; everything else is either an under-link or a later page.

Last updated: 2026-08-24

## Done (do not re-open)

- [x] **GSC cleanup** — sitemaps resubmitted; redirect / `.md` rows validated in Search Console (2026-08-24)
- [x] **Product Hunt** — Electrik + Slate listings live with founder reviews; site embeds + JSON-LD shipped
- [x] **Demo reliability** — `demo.electrik.dev` on Electrik `5.0.0-alpha.14`; login via `demo@electrik.dev` / `password` (Stripe test keys still optional for billing UI)

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

## Next candidates (ship later)

### Earn a fourth homepage card only if ready

| Candidate | When | Notes |
|---|---|---|
| **Docs hub** | Install + concepts pages exist beyond `/install` | Strengthens conversion; until then `/install` is enough |
| **Agent DX** | Real Cursor skill + `llms.txt` story (MCP optional, post-v1) | Matches T3 agent-native bet; do not advertise half-baked |
| **Commercial lane** | Pricing tiers finalized | Prefer pricing/license section, not a peer product card |

### Better as `/ecosystem` or footer later

- Changelog / roadmap (commercial buyer trust)
- Theme / white-label pack (agency angle)
- Integrations as they land (Socialite, Stripe Tax, Paddle, etc.)
- Hosted demo tenants (“try billing without your Stripe keys”)
- Case studies / “built with”
- Electrik Teamwork fork — footnote as “teams engine,” not a peer of Electrik/Slate
- Starter templates (blank SaaS, marketplace) — only after alpha is stable

### Explicit non-goals for ecosystem marketing

- backlink-pilot / directory tooling
- Ads, sponsor widgets, badges as “products”
- Charge and unrelated lab apps
- SubmitMap
- Treating every Laravel/Spatie dependency as an Electrik product

## Suggested future work

- [x] Keep homepage at 3 cards + under-strip
- [x] When docs grow past install, add a real Docs entry (still under-strip or `/docs`, not a card)
- [ ] Add `/ecosystem` page when there are 5+ real pieces (cards + links + later items)
- [ ] Ship Agent DX only after skill/`llms.txt` are useful for install + Slate
- [ ] Mention Teamwork as a one-line “teams engine” on install/docs, not homepage hero row
- [ ] Revisit fourth card only after commercial pricing is public

## Directory outreach (B3 — ready to run)

Runbook: [`marketing/BACKLINK_RUNBOOK.md`](BACKLINK_RUNBOOK.md)  
Config: [`marketing/backlink-pilot.config.yaml`](backlink-pilot.config.yaml) (mirrored to `~/lab/backlink-pilot/config.electrik.yaml`)

Open a **new agent** on the backlink-pilot repo and point it at the runbook. Do not mix Slate (`config.slate.yaml`) with Electrik in the same session.
