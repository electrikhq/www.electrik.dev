# Marketing ops log

Newest first. One short block per run.

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

**Shipped this run:** nothing live (draft-first policy).

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
