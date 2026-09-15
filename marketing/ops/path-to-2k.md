# Path to ~$2k/mo — Electrik commercial licenses

**Goal:** ~**$2,000/month** in Solo/Studio/Agency license sales within 90 days of live checkout.  
**Math:** Solo **$99** · Studio **$149** → e.g. ~20 Solo, ~14 Studio, or a mix (e.g. 8 Solo + 8 Studio ≈ $2k).  
**Not:** ShipFast peak, or a months-long redesign. Prove people pay, then scale reach — **organic base + gated Laravel paid**, see [`distribution-channels.md`](distribution-channels.md).

**Anchor date:** 2026-09-03 (live Buy + homepage conversion pass).  
**Day 90:** ~2026-12-02.  
**Authority:** agent owns execution; Neeraj is human-for-hire (ORDERS only when agent is blocked). Daily prompt: “run daily” / open this chat on a schedule.

---

## North-star metrics (check every Monday)

| Metric | Target by day 90 | Where |
| --- | --- | --- |
| Live Buy → thanks → license email | Works every time | Dodo + Pages webhook + SES |
| Demo usable | Green | demo.electrik.dev |
| `/pricing` → Buy clicks | Rising weekly | GA4 |
| `begin_checkout` / `purchase` | Purchases only with real `payment_id` | GA4 + MP secret |
| Paid licenses / month | **≥ ~$2k** in best month, or clear path | Dodo + ledger |
| Packagist installs (electrik/electrik) | Up vs Aug baseline | Packagist |
| Warm replies | > 0 | hello@ |

---

## What’s already done (do not redo)

- [x] Live Dodo Solo + Studio checkout on `/pricing` ($99 / $149)
- [x] Homepage conversion reorder (pain → install video → price lanes → product CTAs)
- [x] Install walkthrough video (Clipy) on `/install` + homepage
- [x] GA4 Measurement Protocol purchase on webhook + gated client purchase
- [x] `GA4_API_SECRET` on Cloudflare Pages
- [x] Compare pages + honest BSL pricing copy

---

## Phase A — Days 1–14: Money path airtight

**Done when:** stranger can homepage → pricing → pay → get license email; one self-test purchase verified in GA DebugView.

| # | Action | Owner | Status |
| --- | --- | --- | --- |
| A1 | Confirm webhook + fulfillment email on a real/small live buy | Agent + human card | **Green 2026-09-04** — `pay_0NmrG6Q91Dpnqsy7iFC2w` Solo $0 (100% discount), ledger + SES + GA; live webhook + license entitlement fixed |
| A2 | Confirm Dodo redirect includes `payment_id` on thanks | Agent | **Green** with A1 (status API keyed by `payment_id`) |
| A3 | Freeze pricing 90 days ($0 / $99 / $149 / Agency) | Both | Frozen |
| A4 | One “commercial licenses live” post (X + list) | Agent | **Green 2026-09-04** — X https://x.com/electrikhq/status/2095807473953505626 ; Listmonk campaign `18` finished (79 sent, list #11) |
| A5 | Demo green check (login, teams, billing shell) | Agent | **Green 2026-09-04** (`demo@` → Studio dashboard) |

---

## Phase B — Days 15–45: Get in front of people

Ship **one** distribution piece per week (max). Quality > volume.

| Week | Ship | Notes |
| --- | --- | --- |
| 1 | “Licenses live” announcement | Link demo + pricing; grant lane honest — **done** (X + Listmonk) |
| 2 | Install video thread / short clip | Reuse Clipy; terminal + Studio |
| 3 | Electrik vs Jetstream share **or** SEO content piece | Amplify compare *or* Tier C blog (alternate weeks) |
| 4 | r/laravel or Laracasts-style Composer-kit post | Draft-first; no spam |
| 5 | Product Hunt soft relaunch **only if** Buy + demo green | Use `PRODUCT_HUNT.md` |
| 6 | Nudge open awesome-list PRs; 2–3 more lists | Track in ops |

**Not on this table (boss):** AppSumo LTD, black-hat growth, purchased-list cold email. **Raised:** content/SEO (see `distribution-channels.md` Tier C).

Also: keep Packagist / GitHub topics clean; answer every inbound same day.

---

## Phase C — Days 46–90: Convert and tighten

1. Talk to every buyer / almost-buyer (why yes / why not).  
2. One more homepage/pricing friction fix from data — not a redesign.  
3. Agency path: answer Contact same day.  
4. If Solo sells and Studio doesn’t → push Solo. If neither → blocker is reach or trust, not features.  
5. If ≥$2k in a month → document what worked; extend playbook. If first 3–5 paid only → extend another 90 with same cadence.

---

## Weekly rhythm (boring on purpose)

| Day | Do |
| --- | --- |
| **Mon** | Metrics: Packagist, GA (demo, pricing, Buy, purchase), Dodo sales, demo health |
| **Wed** | One content or outreach ship (from Phase B queue) |
| **Fri** | Fix one friction (docs, demo, checkout, email reply) |

Cap marketing at ~5 hours/week if product work is primary. Consistency beats hero weeks.

---

## Explicitly skip for 90 days

- Carbon / BuySellAds / broad Google·Meta ads  
- Laravel News newsletter top spot ($2k+) or Diamond retainers before proof  
- Fancy brand redesign loops  
- New homepage products / fourth ecosystem card  
- Weekly price experiments  
- Cold CTO / purchased-list spam (includes Listmonk list **#4** “US - Tech Companies - Purchased Leads” ~10k — never for Electrik)  
- Zip delivery via Dodo (sell license + install link)

**Paid is not banned** — it is **gated**. First paid tests (if unlocked): **Google Search ≤ $200** and/or **OpenAI/ChatGPT Ads ≤ $100–150** (combined ceiling ~$250–300). Daily $200 is P2. Rules in [`distribution-channels.md`](distribution-channels.md).

---

## Decision rules

| Signal | Action |
| --- | --- |
| Buy clicks ≈ 0 | Fix reach + CTA visibility before more features |
| Buy clicks > 0, purchases = 0 | Fix checkout / trust / price messaging |
| Purchases > 0, &lt; $2k | More Phase B distribution; talk to buyers |
| Demo broken | Drop everything else until green |
| Studio never sells | Soft-pedal Studio; lead Solo + Grant |

---

## This week (execute in order)

1. ~~Demo smoke~~ — green 2026-09-04  
2. ~~Metrics snapshot~~ — Packagist 13 / Slate 90  
3. ~~Licenses-live copy~~ — $99/$149 in `content-queue.md`  
4. ~~A1 money path~~ — live Solo buy verified (ledger + SES email + GA); live webhook + license entitlement shipped  
5. ~~**Human:** paste licenses-live X~~ — https://x.com/electrikhq/status/2095807473953505626  
6. ~~Agent: Made with Laravel + Laravel Daily package submit~~ — LD already under review; MwL thanks page 2026-09-04  

---

## Daily log

### 2026-09-15 (Tue — Launch money path)
- Demo login green (browser)
- Packagist electrik monthly **15** · slate **121** (was 119)
- Dodo: still only Solo $0 verify — **$0 nonzero paid**
- **Shipped:** `/launch` live https://electrik.dev/launch (+ Solo-first `/pricing`); fixed static export path list (first deploy 404’d)
- **Launch outreach +3 Resend:** DevSquad · BinarCode · Codevate
- Listmonk Electrik list still **79** confirmed
- Search spend still held until ~**2026-09-18** + Buy-click signal
- Next: **Wed** Phase B week 4 — Laracasts / r/laravel Composer-kit post

### 2026-09-14 (Mon metrics)
- Demo `/login` **200**; site home + pricing **200**
- Packagist electrik monthly **15** (was 13) · slate **119** (was 108)
- GH electrik **303★** / 22 forks · slate **29★**
- Dodo: still only Solo $0 verify `pay_0NmrG6Q91Dpnqsy7iFC2w` — **$0 nonzero paid**
- Remote MCP PR **merged** — https://github.com/punkpeye/awesome-remote-mcp-servers/pull/189
- **Agency outreach +4 Resend:** Bacancy · Spiral Scout · Goedemiddag · Fruitcake → then raised volume (+Sourcetoad, Agiledrop, Cubet, Coddin, WebReinvent, Square1)
- **Listmonk campaign 24** started → Electrik list #11 (~79): Composer-package angle + pricing CTA
- Search spend still held until ~**2026-09-18** + Buy-click signal
- Next: **Wed** Phase B week 4 — ship Laracasts / r/laravel Composer-kit post (draft ready in `content-queue.md`)
- Money reality: live Buy ~11 days; GA Buy gate red; Apollo rejected — force = partner notes + owned list + community + gated Search

### 2026-09-04
- Live Buy buttons confirmed on `/pricing` (live Dodo product IDs, not test.checkout)
- Demo login → dashboard green
- Packagist electrik monthly **13** (was 4); slate **90**
- **A1 green:** Solo live buy `pay_0NmrG6Q91Dpnqsy7iFC2w` (hello@neerajkumar.name, $0 w/ 100% discount) → ledger + GA + license email
- Fixes shipped: live Dodo webhook endpoint + signing secret; license entitlement `ent_0NmrP6gqSB2Njz4xnBvrn` on Solo/Studio
- **A4 X:** licenses-live posted https://x.com/electrikhq/status/2095807473953505626
- **Dirs:** Laravel Daily package already submitted for review; Made with Laravel submitted (thanks page)
- **A4 Listmonk:** campaign 18 finished — 79 sent to Electrik list #11 ($99/$149 body)
- Next: Phase B week 2 — install Clipy thread (Wed cadence); keep 1 ship/week
- **Authority:** UNBREAKABLE agent-boss rule locked in `.cursor/rules/agent-owner-human-for-hire.mdc`
- **License policy:** Solo/Studio = major line at purchase (5.x + minors); next major = new grant / published upgrade (not DRM)

### 2026-09-10 (10× reach + Agent DX)
- Boss call locked: **same offer, more force** — no product pivot; Agent DX = docs/surface (not AI chat/RAG product)
- **Agent DX shipped:** `AGENTS.md` on `electrikhq/electrik` `5.x` (`7af482a`) · docs https://electrik.dev/docs/getting-started/ai/ · Cursor skill + `llms.txt` · Slate MCP remote
- **X amplify Agent DX** @electrikhq — https://x.com/electrikhq/status/2097947975674990668
- **Agency outreach +4 Resend:** Vehikl · 64 Robots · Curotec · Geeks Ltd — week total **11**
- **GA Buy-click gate (28d):** sessions ~230 / users ~194 · begin_checkout **1** · purchase **2** ($0 verifies) · generic click 12 → **hold Search spend**; calendar unlock still ~**2026-09-18**
- Still **$0 nonzero paid**
- Next: Fri friction; week-4 Laracasts/r/laravel draft; watch remote MCP PR merge

### 2026-09-10 (line-art doodles)
- Tried black/white doodles on resources/home/compare — **killed same day** (looked bad). Pages back to type-only.
- **Directory:** Slate MCP moved to remote list — https://github.com/punkpeye/awesome-remote-mcp-servers/pull/189 (CI check-submission green; closed #12577 on local list)

### 2026-09-09 (Wed ship)
- Pulse: demo login 200; Packagist electrik monthly 13 / slate **108**; resources + Jetstream compare still 200
- **Phase B week 3:** Jetstream compare amplify X @electrikhq — https://x.com/electrikhq/status/2097578996955574767 (shortened to ≤280; account not on Premium long posts)
- Next: Buy-click / GA gate → Google Search ≤$200 if unlocked; Fri friction; week 4 Laracasts/r/laravel draft

### 2026-09-08 (SEO resources shipped)
- Built `/resources` hub + 3 guides: laravel-saas-starter-kit, saas-boilerplate, build-laravel-saas
- 301: `/resources/laravel-saas-boilerplate` → starter-kit page
- Nav + footer + llms.txt + export paths/sitemap inputs wired
- Next: Wed Jetstream amplify; later Larafast-alternative resource if needed

### 2026-09-08 (Keyword Planner + Trends MoM/YoY)
- Human pasted Superlemon KP plan (all locations). Canvas: `electrik-keyword-demand.canvas.tsx`
- **Absolute (KP):** `saas boilerplate` **1k–10k** · `saas starter kit` / `laravel saas starter kit` / `larafast` / `laravel spark` / `openai saas` **100–1k** · `ai saas` **1k–10k** · `ai boilerplate` / `cursor saas` **10–100** · `jetstream alternative` / `ai saas starter` **—** · `shipfast` **10k–100k** (polluted — ignore for bidding)
- **Trends MoM (WW relative, openai saas on same chart):** May peak openai **88** / ai boilerplate **8** → Jul **37/4** → Aug **13/1** → early Sep **6/1** — AI terms **cooling**, not accelerating
- **YoY:** Sep 2025 openai ~**37** vs early Sep 2026 ~**6** (down after spring spike); saas boilerplate soft (~6 → ~1 relative)
- **Call:** paid Search → Laravel kit / boilerplate seeds; Agent DX = docs not keywords; no AI-chat product rebuild for a fading spike

### 2026-09-08 (clarity / demand data)
- **Keyword Planner:** logged into Ads CID `707-599-7930` — UI blocked by **ad blocker** overlay (cannot pull absolute volumes until disabled for ads.google.com)
- **Google Trends (WW, 12mo averages):** `saas boilerplate` **43** · `ai boilerplate` **44** · `laravel spark` **22** · `makerkit` **15** · `larafast` **0** (below Trends threshold) · `laravel saas starter` / `ai saas starter` / `cursor boilerplate` insufficient data
- Rising related to saas boilerplate: django saas boilerplate +180%, makerkit +100%, supastarter +100%
- **GSC electrik.dev (~3mo):** 40 clicks · 3.41k impr · CTR 1.2% · avg pos 18.1 — queries: `electrik` 11/1568 · `laravel saas starter kit free` 4/26 · `laravel saas kit` 1/108 · `laravel saas starter kit` 1/89 · `laravel saas` **0/427** (impressions without clicks)
- Clarity still needed: KP absolute volumes (after adblock) · GA Buy clicks · 5 buyer interviews

### 2026-09-08 (AI trends research)
- Researched two distinct “AI starter” bets with vendor sources (not SERP alone): **A Agent DX** vs **B AI product features** (chat/RAG/credits)
- Evidence: MakerKit/TurboStarter/supastarter sell A hard; B is optional/upsell (Turbo AI Kit) or billing-depth (MakerKit meters) or Larafast OpenAI helpers; ShipFast skips B and still wins solo mindshare
- Correction: Electrik already has Stripe **metered usage** — gap is chat/credits UX, not metering primitive
- Canvas: `electrik-ai-trends-research.canvas.tsx`
- Call: raise A + document meter-for-AI; defer B2/B3 unless buyers ask

### 2026-09-08
- **Tue pulse:** demo `/login` **200**; Packagist electrik **13** / slate **104**; GH electrik **299★** / slate **27★**
- Dodo: still only Solo $0 verify — **0 nonzero paid**
- **Agency outreach +4 via Resend:** Tighten (`2b4bdb8e…`) · Kirschbaum (`4303626f…`) · Acquaint (`07d5c5e3…`) · byte5 (`1d824695…`) — week total ~**7** notes
- Decision locked: **no Slate Pro** this quarter (Slate stays free bait → Electrik paid)
- Next: **Wed** Jetstream compare amplify → https://electrik.dev/compare/electrik-vs-jetstream (+ pricing)

### 2026-09-07
- **Mon metrics:** demo `/login` 200; Packagist electrik **12** / slate **102**; GH electrik **297★**; Dodo still only Solo $0 verify (no new paid)
- Listmonk Electrik #11 = **79**; Slate #15 = **1** (verify sub)
- **Phase B week 2 ship:** Install Clipy X — https://x.com/electrikhq/status/2096849840575832351
- **Resend:** domain `updates.electrik.dev` **verified** (Cloudflare / Tokyo); key in `.env` (`RESEND_KEY`); helper `marketing/ops/resend.cjs`
- **Outreach sent via Resend:** Steadfast (`876b070d…`) + Redberry (`9851ada6…`); founder copy `b823e748…`; Jump24 blocked by reCAPTCHA → ORDER
- **LN Slate live:** https://laravel-news.com/link/18766 (5:00am ET) — ~**15 clicks** by evening IST
- **LN amplify X:** https://x.com/electrikhq/status/2096911312165146696
- Slate themes playground + Flux-style chips shipped earlier today
- Note: X pin fixed to Solo **$99** / Studio **$149** (was obsolete $149/$399)
- Next: Wed Jetstream compare amplify

### 2026-09-06
- Daily pulse (Sun): demo `/login` 200; Packagist electrik **12** / slate **95**
- Install Clipy X copy finalized in `content-queue.md` (ship Mon/Wed — not same week as licenses-live)
- `outreach.csv` seeded (Jump24, Steadfast, Tighten, Redberry + GitHub engagers queue) — status drafted
- LN Slate still scheduled **2026-09-07 05:00**
---

## License policy (boss)

**Commercial Solo/Studio** = permission for the **major line current at purchase** (today **5.x**) + minors/patches on that line.  
**Next major** (e.g. 6.x) = new commercial grant or published paid upgrade — not silent lifetime-all-futures.  
**Agency** = negotiate major scope in the deal.  
**Grant (BSL)** = still free for eligible indie use on whatever version they install.  
**Enforcement** = legal/permission + certificate. **Not** DRM / private Packagist / activation keys.

Copy on `/license`, `/pricing`, license email, package README.

---

## Related docs

- [MARKETING_OPS.md](../MARKETING_OPS.md) — cadence, hard rules, draft-first  
- [homepage-redo-brief.md](homepage-redo-brief.md) — homepage structure (shipped)  
- [PRODUCT_HUNT.md](../PRODUCT_HUNT.md) — PH copy when Buy is proven  
- [state.yaml](state.yaml) — live focus / blockers
