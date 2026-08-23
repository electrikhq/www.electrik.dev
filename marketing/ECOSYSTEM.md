# Electrik ecosystem roadmap

Working notes for www.electrik.dev marketing. Homepage keeps **three cards**; everything else is either an under-link or a later page.

Last updated: 2026-08-23

## Live on homepage (now)

### Product cards (max 3)

| Item | Role | CTA |
|---|---|---|
| **Electrik** | SaaS starter kit (hero) | Install guide |
| **Slate** | UI kit Electrik ships on | Slate docs |
| **Demo** | Live proof | Open demo |

### Under-strip (not cards)

Docs · License · GitHub

Config: `config/site.php` → `ecosystem` + `ecosystem_links`.

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

- [ ] Keep homepage at 3 cards + under-strip
- [ ] When docs grow past install, add a real Docs entry (still under-strip or `/docs`, not a card)
- [ ] Add `/ecosystem` page when there are 5+ real pieces (cards + links + later items)
- [ ] Ship Agent DX only after skill/`llms.txt` are useful for install + Slate
- [ ] Mention Teamwork as a one-line “teams engine” on install/docs, not homepage hero row
- [ ] Revisit fourth card only after commercial pricing is public and demo is reliable

## Related

- Master plan Track B: marketing site, SEO, directories
- Site config: `www.electrik.dev/config/site.php`
- Directory outreach: `www.electrik.dev/marketing/backlink-pilot.config.yaml`
