# Electrik directory outreach — agent runbook (B3)

Ready-to-run brief for a **new agent window**. Product: **Electrik** (not Slate).

## Paths

| What | Where |
|---|---|
| Tool install | `/Users/neerajsohal/lab/backlink-pilot` |
| Electrik config | `config.electrik.yaml` (in that repo) |
| Slate config (do not use) | `config.slate.yaml` / `config.yaml` |
| Electrik tracker | `submissions.electrik.yaml` (auto via product name) |
| Day-1 batch (10 sites) | `batch-electrik-day1.txt` |
| Full free-auto list | `batch-electrik-free-auto.json` |
| Marketing mirror | `www.electrik.dev/marketing/backlink-pilot.config.yaml` |

## Rules

1. Always `--config config.electrik.yaml --engine bb`
2. Pace: **5–10 sites/session**, **≥1 min** between sites
3. Skip `status: dead` / `paid`; skip OpenHunts automation; **Product Hunt = manual only**
4. Never re-submit a site already in `submissions.electrik.yaml`
5. Do **not** switch to Slate config in this session

## First session (copy-paste)

```bash
cd /Users/neerajsohal/lab/backlink-pilot
npm install          # if needed
npm install -g bb-browser   # if needed
bb-browser open about:blank

# Verify config
node src/cli.js status --config config.electrik.yaml
node src/cli.js submit https://www.futuretools.io/submit-a-tool --config config.electrik.yaml --engine bb --dry-run

# Real first submit (one site)
node src/cli.js submit https://www.futuretools.io/submit-a-tool --config config.electrik.yaml --engine bb
```

Then work through `batch-electrik-day1.txt` one URL at a time.

## Awesome-list drafts (manual GitHub Issues)

```bash
cd /Users/neerajsohal/lab/backlink-pilot
node src/cli.js awesome sindresorhus/awesome --config config.electrik.yaml
# Also useful: awesome-laravel, awesome-php, awesome-selfhosted (pick Laravel/PHP-relevant lists)
```

Drafts land under `drafts/` — open Issues manually; do not spam.

## After the session

- Paste `node src/cli.js status --config config.electrik.yaml` summary
- Note any dead URLs / captcha blocks for next day
- Stop at 10 successes or when pacing feels noisy

## Product facts (if a form asks)

- Name: Electrik  
- URL: https://electrik.dev  
- GitHub: https://github.com/electrikhq/electrik  
- Logo: https://electrik.dev/images/electrik-mark.png  
- Email: hello@neerajkumar.name  
- License: BSL 1.1 + free indie grant; commercial for companies  
- Stack: Laravel 12, Livewire 4, Slate 3, Stripe Cashier on teams  
