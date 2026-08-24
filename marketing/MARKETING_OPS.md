# Electrik marketing ops

Operating brief for the marketing agent. **Authority:** ship content, drafts, directory outreach, PH/GitHub hygiene, and warm outreach. Do **not** cold-spam CTOs or buy email lists.

Last updated: 2026-08-24

## Goal (90 days)

Make Electrik easy to discover and try for Laravel SaaS builders, then convert agencies/studios via commercial license + studio contact.

**North-star signals (track weekly):**

| Signal | Where | Target trend |
|---|---|---|
| Packagist installs (Electrik + Slate) | packagist.org | Up month over month |
| GitHub stars / unique cloners | GitHub | Steady climb |
| Demo visits + successful logins | Analytics + demo | Demo used, not just bounced |
| Docs `/install` + `/docs` engagement | Analytics / GSC | Install path completes |
| Warm replies / license inquiries | `hello@electrik.dev` | Any reply > vanity metrics |
| Directory / awesome listings live | tracker files | Completions, not spray |

## Cadence

| Mode | When | What you do |
|---|---|---|
| **Daily pulse** (15–25 min) | Mon–Fri | Open this chat: “run marketing daily”. Agent does today’s checklist, logs result, stops. |
| **Weekly deep** (60–90 min) | One weekday (prefer Mon or Wed) | “run marketing weekly”. Content + outreach + metrics review. |
| **Autopilot** | After 2–3 manual weeks feel stable | Same prompts on a schedule / Cursor Automation; agent uses logged state and credentials you provided. |

**Default weekly day:** Wednesday. Change in `marketing/ops/state.yaml` if needed.

## Hard rules

1. **Electrik is hero**; Slate is sibling; demo is proof — never confuse brands in a post.
2. **Honest BSL** — free for indie grant; commercial for companies/agencies. Never say “free for commercial use.”
3. **No cold CTO / purchased-list spray.** Warm or semi-warm only (stars, agencies that ship Laravel SaaS, people who engaged).
4. **Backlink-pilot:** Electrik config only; 5–10 sites/session; ≥1 min between; no PH automation.
5. **Do not mix** Slate and Electrik directory sessions.
6. **Alpha honesty** — say APIs can move; push demo + install, not “production guaranteed.”
7. **Ask before** paid ads, buying tools, or sending >20 emails in one day.
8. **One browser profile** — all web work uses `marketing/ops/browser.sh` (see `marketing/ops/BROWSER.md`). Never bare `bb-browser` or a second Chrome profile for marketing.
9. **Draft-first publishing** — until `state.yaml` → `publish_policy: autopilot`, all X/PH/GitHub posts and outbound emails are **drafts for user approval**. No publishing without explicit OK in chat.

## Publish policy

| Phase | Policy |
|---|---|
| **Now → ~3 weeks** | `draft_first` — agent writes drafts in `ops/content-queue.md` or chat; user approves; then agent publishes via marketing browser |
| **Later** | Flip `state.yaml` → `publish_policy: autopilot` when drafts consistently need zero edits |

## Outbound email

### Mailchimp (legacy list — primary)

~200–300 Electrik subscribers from prior years live on **Mailchimp**. Warmest owned channel.

**Policy (locked 2026-08-24):**
- Use the list: one re-engagement, then ≤1 email/month.
- Stay on Mailchimp for broadcasts (do not migrate newsletters to SES).
- Soft CTA only; no commercial hard sell on re-entry.
- Sunset chronic non-openers after 1–2 sends.

**API (preferred over browser):**
- Key in local `www.electrik.dev/.env` → `MAILCHIMP_API_KEY` + `MAILCHIMP_SERVER_PREFIX` (never commit)
- Helper: `node marketing/ops/mailchimp.cjs ping|lists|send-reengagement`
- Audience id (Electrik): `f8de632e28` (us18)

### Transactional (contact / app)

Cloudflare routing **receives** at `hello@electrik.dev`; **sending** needs SMTP/API credentials in `.env` (never commit).

| Option | Notes |
|---|---|
| **AWS SES** | Fine if you already have AWS; verify electrik.dev domain, IAM user with `ses:SendEmail` only |
| **Resend** | Simpler Laravel setup; good default if no AWS preference |

Wire `MAIL_MAILER` once keys are in local `.env`. Separate from Mailchimp. Warm 1:1 outreach stays draft-first until send is configured.

## Browser (locked profile)

**Path:** `~/lab/electrik/.browser/electrik-marketing` via `BB_BROWSER_HOME`  
**Wrapper:** `marketing/ops/browser.sh` — agent **must** use this on every run.

You log in once in that Chrome window; sessions persist for PH, GitHub, X, LinkedIn, Google/GSC, directories, and warm outreach tabs.

Setup: [`marketing/ops/BROWSER.md`](ops/BROWSER.md)

## Access checklist (you provide)

Store secrets outside git (Cursor secrets, 1Password, env). Tell the agent *how* to use them; do not commit passwords.

| Access | Used for | Status |
|---|---|---|
| GitHub `electrikhq` | Issues, discussions, awesome-list drafts/PRs, release notes | **Ready when you hand over** |
| Product Hunt | Update Electrik listing fields; reply to comments | **Ready when you hand over** |
| X `@electrikhq` | Short posts + Loom links | **Ready when you hand over** |
| LinkedIn (personal and/or company) | Longer founder posts; agency angle | **Ready when you hand over** |
| `hello@electrik.dev` send (Gmail / Cloudflare Email Routing + client / Resend) | Warm replies and small agency notes | **Ready when you hand over** |
| Google Analytics + Search Console | Weekly metrics | **Ready when you hand over** |
| Backlink-pilot machine (bb-browser) | Directory day batches | Same profile via `BB_BROWSER_HOME` |
| Demo Stripe test keys (optional) | Billing UI on demo | Optional |

**First handoff:** paste or attach login method for GitHub + Product Hunt first (highest leverage). Then X, then email send, then GSC/GA.

## Channel priority (do in this order)

1. **Install + demo trust** — fix friction before louder promotion  
2. **Product Hunt** — update listing; invite warm reviews (no vote farms)  
3. **Directory / awesome** — `BACKLINK_RUNBOOK.md`  
4. **Laravel-world content** — one concrete post/week (package model, teams+Stripe, Slate shell)  
5. **GitHub** — discussions, issue triage, stale issue close/retarget for 5.x  
6. **Warm email** — stars, past engagers, Laravel agencies (≤20/week unless replies are good)  
7. **Slate-led discovery** — UI posts that deep-link Electrik as “SaaS shell on Slate”

## Daily pulse checklist

Agent runs and logs in `marketing/ops/log.md`:

- [ ] **Browser preflight:** `marketing/ops/browser.sh status` (start daemon if needed)  
- [ ] Check `hello@electrik.dev` / support threads (in marketing browser) for reply drafts  
- [ ] Triage GitHub: new issues/PRs/discussions on `electrik` + `slate` (via marketing browser)  
- [ ] One small discovery action **or** content micro-task (see rotating queue below)
- [ ] Update `marketing/ops/state.yaml` (`last_daily`, next focus)

**Daily rotating queue** (pick one per day):

| Day | Focus |
|---|---|
| Mon | Directory batch (3–5 sites) **or** PH hygiene |
| Tue | GitHub / docs friction fix |
| Wed | Weekly deep (see below) |
| Thu | Content draft or publish |
| Fri | Warm outreach (5 people) + metrics skim |

## Weekly deep checklist

- [ ] Metrics skim (Packagist, GH, GA/GSC if available) → note in log  
- [ ] Ship **one** public artifact (post, Loom script + publish if access, changelog blurb, docs tip)  
- [ ] Directory: finish or advance day batch toward 10 successes  
- [ ] PH: listing fields current; reply to any new reviews/comments  
- [ ] Warm list: 10 personal notes (agencies / engagers) — drafts if no send access  
- [ ] Propose next week’s single theme in `state.yaml`

## Content themes (rotate; one per week)

1. Composer package vs copy-on-install kits  
2. Teams + Stripe on the team model  
3. BSL grant vs commercial (honest dual lane)  
4. Slate 3 as the UI story → Electrik as shell  
5. Install path walkthrough (Loom)  
6. “Built with” / studio case when available  

**Pitch line (always):**

> Electrik is a Laravel SaaS starter as a Composer package — auth, teams, Stripe billing, Slate UI — full features in source; free for indies under BSL, commercial for companies.

## Warm outreach (not cold CTOs)

**Targets:** Laravel agencies, freelancers shipping SaaS, PH/GitHub engagers, Slate users.

**Template (short):**

```
Subject: Electrik for Laravel client SaaS

Saw you ship Laravel products for clients. Electrik is a Composer package
(auth, teams, Stripe on the team, Slate UI) — full source; commercial
license for agency work.

Demo: https://demo.electrik.dev (demo@electrik.dev / password)
Site: https://electrik.dev

Happy to answer if useful — otherwise ignore.
```

Max **20 sends/week** until reply rate is known. Log every send in `marketing/ops/outreach.csv`.

## Files the agent owns

| File | Purpose |
|---|---|
| `marketing/MARKETING_OPS.md` | This playbook |
| `marketing/ops/state.yaml` | Cadence state, next focus, blockers |
| `marketing/ops/log.md` | Session diary (newest first) |
| `marketing/ops/outreach.csv` | Warm outreach tracker |
| `marketing/ops/content-queue.md` | Draft titles / Loom scripts |
| `marketing/BACKLINK_RUNBOOK.md` | Directory B3 |
| `marketing/PRODUCT_HUNT.md` | PH paste copy |
| `marketing/ECOSYSTEM.md` | Product positioning (do not violate) |

## How to invoke

**Daily:**

```
Run Electrik marketing daily. Follow marketing/MARKETING_OPS.md.
Read ops/state.yaml and ops/log.md first. Log what you did.
```

**Weekly:**

```
Run Electrik marketing weekly. Follow marketing/MARKETING_OPS.md.
Update metrics, ship one artifact, advance directories + warm outreach.
```

**Autopilot (later):** same prompts on schedule; agent must still obey hard rules and log every run.

## Definition of a good week

- One public artifact shipped  
- Directory progress without spam  
- Inbox/GitHub not rotting  
- At least one honest conversation started (reply, issue, PH comment, or email)

## Explicit non-goals

- Cold CTO databases  
- Paid ads (until install is boring and pricing is clear)  
- Fake reviews / vote buying  
- Treating Charge / SubmitMap / backlink tooling as products on the homepage
