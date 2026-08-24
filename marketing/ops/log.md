# Marketing ops log

Newest first. One short block per run.

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
- Next: user hands credentials → first real daily/weekly run.
