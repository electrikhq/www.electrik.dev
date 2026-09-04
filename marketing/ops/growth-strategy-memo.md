# Growth strategy memo — thorough pass

**Owner:** agent (boss)  
**Date:** 2026-09-04  
**Canvas:** open beside chat — `electrik-growth-strategy.canvas.tsx`  
**Related:** [`path-to-2k.md`](path-to-2k.md) · [`distribution-channels.md`](distribution-channels.md)

## Premise

Pressure-test black hat, gray hat, AppSumo, content, and cold outreach against Electrik’s real constraints — not against “what growth Twitter does.”

Constraints that dominate:

1. **Product** — Composer package inside the buyer’s app forever; dual BSL grant + commercial. Trust is the surface.
2. **Economics** — ~$99–149 one-time. Need ~14–20 pays/mo for ~$2k. Cannot buy expensive awareness or absorb LTD support forever.
3. **Time** — ~5h/week marketing if product stays primary.
4. **Infra** — shared Listmonk/SES with QBF brands; one spam event hurts more than Electrik.

## Unit economics → reach design

Owned Electrik list (~79) + small X cannot carry $2k alone. Rough funnels:

| Path | What it implies |
| --- | --- |
| Site-led, mid conversion | Hundreds–thousands of pricing visits/mo → needs SEO + niche paid |
| Conversation-led | ~100 serious agency/demo conversations/mo → needs personalized outbound |
| Deal-marketplace-led | Volume of wrong buyers → support + price-anchor damage |

So the portfolio must mix **compounding content**, **niche paid (gated)**, and **personalized outbound** — not one hero tactic.

## Channel verdicts (after thorough pass)

### Black hat — never

Fake votes, fake reviews, PBNs, scraped blasts, burner-domain purchased mail. Expected value negative at this ACV: ban/SES/trust death vs a noisy spike. Developers who install Composer packages notice BS.

### Gray hat — split

| Do | Don’t |
| --- | --- |
| Aggressive honest SEO (compare/vs) | Engagement pods / fake proof |
| Guest posts with disclosure | Mass junk directories |
| 10–20 personal agency notes/week | Purchased list #4 (~10k) ± new domain |
| One soft QBF founder note → warm #7 | Astroturf Reddit |

**Correction:** “No cold CTO spray” was wrongly treated as “no outbound.” Personal agency outreach was already in `MARKETING_OPS.md` and under-executed.

### AppSumo / LTDs — skip 90 days; revisit only on failure

Real money exists there. Early Electrik fit is poor: LTD expectations vs evolving package, BSL confusion, deal-hunter ICPs, price anchoring under Solo $99, support load. **Revisit gate:** if by ~day 60 paid sales ≈ 0 *and* free+outbound+gated paid failed, design a **capped Solo-only** experiment with explicit non-goals — not a default lever.

### Content / blogs — raise (was the real gap)

Compare pages live; no blog engine. Content is slow for 90-day cash but is the compounding asset. Cadence: ~1 long piece / 2 weeks, each piece also distributed (X / later list). Themes: Composer vs scaffold, teams+Stripe, BSL honesty.

### New sending domain — not a strategy

Isolates reputation only. Does not create consent or Laravel intent on purchased CTOs. Electrik already sends list mail as `hello@electrik.dev`.

## Revised portfolio (boss)

**Primary:** weekly public ship · biweekly SEO/content · 10–20 agency notes/week · PH once · dirs · same-day replies · gated Daily/LN when Buy clicks exist but volume is low.

**Out (90d):** black hat · list #4 blast · early AppSumo · Carbon/Meta/LN $2k newsletter.

## Why not “everything”

At this ACV and hours, stacking AppSumo + cold farm + black hat + blogs + paid is busywork with correlated spam/ban risk. Diversify across **Laravel-intent** mechanisms that don’t all die when one domain is burned.

## Execution order

1. Install Clipy thread (Phase B week 2)  
2. Start `outreach.csv` rhythm (10–20/week)  
3. Outline first SEO/content piece  
4. Jetstream amplify  
5. Buy-click gate → P1 paid if unlocked
