# Marketing ops log

Newest first. One short block per run.

## 2026-08-25 — Kit replaces Mailchimp

- API key in local `.env` (`KIT_API_KEY`). Helper: `marketing/ops/kit.cjs`
- Form **Newsletter site** `9841384` / uid `5e39730e50`
- Site newsletter → `POST /newsletter/subscribe` (server Kit), Mailchimp form disabled
- Privacy copy → Kit
- ~78 subscribers visible via API (import may still be incomplete vs old ~207)
- Brevo plan cancelled — using Kit

## 2026-08-24 — P0 executed (agent owner)

**Decisions locked:** agent ships; Neeraj observes. Mailchimp abandoned → Brevo when credentials arrive. Bridge before more discovery.

**Shipped:**
- Slate→Electrik bridge: slate homepage CTA, docs/electrik, Electrik `/install` callout + docs intro, README lines (slate / electrik / slate-blocks)
- GitHub Release [v5.0.0-alpha.15](https://github.com/electrikhq/electrik/releases/tag/v5.0.0-alpha.15); demoted `0.0.13` + `v0.0.1` to pre-release with deprecate notes

**Blocked:**
- X pin/delete garbled — Chrome CDP down
- List mail — await Brevo

## 2026-08-24 — Mailchimp blocked

Mailchimp blocked the Electrik account after the re-engagement send. **Stop all Mailchimp use** (API + UI). Await Brevo (or other ESP) credentials; migrate list before next broadcast. Local `MAILCHIMP_*` in `.env` is dead — do not call.

## 2026-08-24 — Mailchimp API + re-engagement sent

- API key stored in local `www.electrik.dev/.env` (`MAILCHIMP_API_KEY`, gitignored). Helper: `marketing/ops/mailchimp.cjs`
- Audience **Electrik** — 207 subscribers (`f8de632e28`)
- Campaign **0fb6a8a24a** created + send triggered (subject: Electrik is back — Laravel 12, Composer package)
- Prefer API over browser builder for future list mail

## 2026-08-24 — Mailchimp list decision

**Decision:** Re-engage the ~200–300 legacy Mailchimp subscribers. Highest-leverage warm channel we own.

- One “we're back” email (copy in `content-queue.md`), then ≤1/month
- Stay on Mailchimp; soft CTA; sunset non-openers after #1–2
- Blocked only on Mailchimp login in marketing Chrome (or Neeraj paste-sends from queue)

## 2026-08-24 — approve-all execution

User: **approve all** (PH, X, directories day-1, GitHub cleanup).

**Shipped live:**

| Item | Result |
|---|---|
| Product Hunt | Tagline + description + website live — https://www.producthunt.com/products/electrik (SEO `<title>` still old) |
| X `@electrikhq` | 5.x Composer-package post live (~08:48 UTC) |
| Future Tools | Submitted — “Matt will review…” |
| AI Valley | Form filled; CF7 server error — **not** accepted; retry next run |
| GitHub | Default branch → `5.x`; description updated; closed #27, #26; commented #37 |

**Left for user / next run:**

- Delete two garbled same-day X posts (~08:07 / 08:11 UTC) if you want a clean timeline
- Optional: pin the new 5.x tweet
- Laracasts / r/laravel draft held for week 2 (not posted)
- AI Valley retry
- SES/Resend for outbound email

## 2026-08-24 — weekly run #1 (draft-first)

**Browser:** daemon up, 7 tabs (GA, GSC, GitHub, PH, X, LinkedIn). PH opened — still shows 2022 tagline.

**Metrics (baseline):**

| Signal | Value |
|---|---|
| GitHub stars (electrik) | 293 · 22 forks · 6 open issues |
| Default branch | still `4.x` (5.x active on Packagist) |
| Packagist electrik | 1,575 total · **4/month** · latest `5.0.0-alpha.14` |
| Packagist slate | 2,545 total · **31/month** · 5/day |
| Directory submissions | 0 recorded (`submissions.electrik.yaml`) |
| GA / GSC | logged in; numeric pull deferred to next run via browser |

**Shipped this run:** drafts only — execution in approve-all block above.

**Drafts ready for approval:** PH listing fields, X post, Laracasts/r/laravel post — see `content-queue.md`.

**GitHub triage (recommend after approval):**

- Close or retarget #27 (2FA) — shipped in 5.x
- Close or retarget #26 (email verification) — likely shipped; verify
- Comment on #37 (install fails) — point to 5.x `/install` + alpha.14
- Leave #40 billing refactor as 5.x roadmap
- #11 sponsors page — low priority
- #7 Slate dark mode — slate repo, not electrik

**Product fixes that help conversion (not marketing):**

- Flip GitHub default branch `4.x` → `5.x`
- GitHub description/topics still stale (open-source, laravel9, nova)

**Next week focus:** publish approved X + PH after user OK; directory day-1 (Future Tools, AI Valley — user or agent with approval); skim GA/GSC numbers in browser.

## 2026-08-24 — publish policy + email plan

- `publish_policy: draft_first` — user approves posts/emails before publish
- Outbound email: AWS SES or Resend when user adds keys to `.env` (receive-only via Cloudflare for now)
- Electrik-first; LinkedIn company page deferred
- Removed `marketing/` from `.gitignore so ops playbook is in repo

## 2026-08-24 — marketing browser logged in

- User completed one-time login in `~/lab/electrik/.browser/electrik-marketing`
- Ready: GitHub, Product Hunt, X, Google (Gmail/GA/GSC)
- GA: account 247243927 / property 347307308
- GSC: sc-domain:electrik.dev
- LinkedIn: personal OK; **no company page yet** — defer until first weekly post
- Next run: `run marketing weekly` (PH fields + backlink day-1 + metrics skim)

## 2026-08-24 — browser profile locked

- Single marketing profile: `~/lab/electrik/.browser/electrik-marketing`
- Wrapper: `marketing/ops/browser.sh` + `marketing/ops/BROWSER.md`
- Waiting for user to log in once, then set `state.yaml` → `browser.logged_in: true`

## 2026-08-24 — playbook bootstrapped

- Created `MARKETING_OPS.md`, `ops/state.yaml`, outreach/content stubs.
- Cadence: daily pulse + Wednesday weekly deep; autopilot after 2–3 manual weeks.
- Waiting on credentials: GitHub, Product Hunt, X, LinkedIn, email send, GA/GSC.
- Next: user hands credentials → first real weekly run.
