# Marketing ops log

Newest first. One short block per run.

## 2026-09-21 — MIT switch (BSL + kit licenses retired)

- Electrik package: LICENSE MIT · composer `5.5.0` / `license: MIT` · README + AGENTS
- Site: home/nav/footer/pricing/license/FAQ/Launch/compare/docs → MIT free + Launch $6.9k money path
- Solo/Studio kit licenses **retired**; `commercial_tiers` emptied
- Ops: `state.yaml` + `money-path-launch-and-vertical.md` locked to Launch-only cash
- Next: tag/push `v5.5.0` on `5.x` → Packagist; deploy www

## 2026-09-17 — Portal SKIP (founder veto)

- Portal MVP coding **not starting** — same sales stuck risk + heavy client-portal competition
- Stay on Electrik: Launch $6.9k + Solo/Studio licenses + non–official-partner outreach
- Spike doc kept as archive only (`ops/portal-mvp-spike.md`)

## 2026-09-17 — Thu pulse + non-partner outreach

- **Rule locked:** skip official Laravel Partners (`laravel.com/partners`) — separate Neeraj engagement; Electrik notes go to non-partner shops only
- Metrics: demo `/login` 200; Packagist electrik **16**/mo · slate **122**/mo; GH 303/29; Dodo still only $0 verify `pay_0NmrG6Q91Dpnqsy7iFC2w`
- Portal MVP spike: `ops/portal-mvp-spike.md` (models/roles/week map)
- Resend **+10** non-partner (5 Launch / 5 license): Renav · Chilliapple · MWN Digital · Tonca · Boldally · Pixlogix · Zedrox · Saga Softwares · Pawon · Hutko
- Listmonk: **#26 finished** (79); draft **#25 deleted**
- Reddit: helpful comment at **6 points** in r/laravel → Composer post **live** https://old.reddit.com/r/laravel/comments/1wios0e/why_we_ship_electrik_as_a_composer_package/ (not AutoMod-removed on submit)
- Discord `#starter-kits` Composer note **posted** (qwertymaniac 3:07 PM IST): https://discord.com/channels/297040613688475649/1338965402717261894/1550078159406243890
- Buy-click Search unlock calendar ~**2026-09-18** — still no nonzero sales; leave gated unless GA shows Buy clicks

## 2026-09-15 — r/laravel karma comments + repost (still AutoMod)

- Reddit login done (`u/Otherwise_Economy576`)
- Helpful comments ×2 (non-promo):
  - AWS/BAA thread: https://old.reddit.com/r/laravel/comments/1wg37am/
  - Background jobs poll: https://old.reddit.com/r/laravel/comments/1wguqhd/
- Repost: https://www.reddit.com/r/laravel/comments/1wgv7gr/why_we_ship_electrik_as_a_composer_package/ — **AutoMod removed again** (needs *earned* +2 comment karma / upvotes, not just 2 comments)
- Earlier twin also removed: `1wgsugw`
- Modmail compose opened to `/r/laravel` (Send may need human if UI disables)
- **Laracasts = paid → SKIP** (locked 2026-09-15). Free alt: Laravel Discord + Reddit karma wait/modmail
- Next: Portal MVP spike; Discord Composer note; wait upvotes / mod approve `1wgv7gr`

## 2026-09-15 — r/laravel Composer post (auto-removed)

- Posted: https://www.reddit.com/r/laravel/comments/1wgsugw/why_we_ship_electrik_as_a_composer_package/
- AutoModerator removed: account needs **+2 karma from comments in r/laravel** before first post
- Next: leave 2+ helpful non-promo comments in r/laravel → modmail or repost; also Laracasts discuss

## 2026-09-15 — BLAST 10× (same offers, more force)

**Diagnosis:** drip (~10 notes/wk + 79 list) cannot buy $2k at $99 ACV with ~0 Buy clicks. Force up; no AppSumo yet; no purchased list.

**Shipped:**
- Site: Buy Solo primary in nav/hero; Launch in nav/footer/hero (deploy `9449c64`)
- Listmonk **#26 running** → Electrik list #11 — Launch $6,900 announce (duplicate draft #25 left — delete in admin)
- Resend **+10** agencies (5 Launch / 5 license): Amyla, MBC, Xevon, Vulpo, Dotbite, JustBetter, Digital Natives, APARTNER, Code World Tech, Winkely
- Earlier today: /launch live, Solo-first pricing, +3 Launch notes, GH triage

**Pending (X compose filled — needs Post click if agent blocked):** Launch amplify @electrikhq  
**Next:** r/laravel + Laracasts Composer post · Portal MVP spike · Search unlock ~Sep 18 if Buy clicks appear

## 2026-09-15 — Daily: Launch live + 3 agency notes

- Shipped https://electrik.dev/launch ($6,900 / 14d) + Solo-first pricing (home/contact/pricing)
- Fix: `get_export_paths.php` missing `launch` → first CF deploy 404; second deploy green
- Resend Launch pitch: DevSquad, BinarCode, Codevate
- Metrics: Packagist slate 121; demo green; Dodo still $0 nonzero; Listmonk #11 = 79
- **GH triage (after auth refresh):** closed electrik #37 (install→5.x), #11 (stale sponsors), #40 (billing superseded by 5.x); left #7 dark mode open. Merged slate Dependabot #11–#14 (smoke green).
- Next: Wed Laracasts/r/laravel; watch Launch replies; Portal spike after first deposit/inbound

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
