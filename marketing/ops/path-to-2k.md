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

**Paid is not banned** — it is **gated**. First paid test (if unlocked): Laravel Daily $200 mention or LN sponsored post ≤~$500. Rules in [`distribution-channels.md`](distribution-channels.md).

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
