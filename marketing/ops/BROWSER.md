# Marketing browser (one profile, all runs)

Electrik marketing uses **one dedicated bb-browser profile** so logins survive across daily/weekly runs.

**Profile path:** `~/lab/electrik/.browser/electrik-marketing`  
**Env:** `BB_BROWSER_HOME` (set automatically by `browser.sh`)

## Agent rule (hard lock)

Every marketing run that touches the web **must** use:

```bash
/Users/neerajsohal/lab/electrik/www.electrik.dev/marketing/ops/browser.sh <command>
```

Never use bare `bb-browser` for marketing (that would use `~/.bb-browser` and a different cookie jar).

Never use Playwright/rebrowser for PH, X, LinkedIn, or Gmail — only this profile.

## One-time setup (you)

1. Start the marketing browser:

```bash
cd /Users/neerajsohal/lab/electrik/www.electrik.dev
chmod +x marketing/ops/browser.sh   # once
marketing/ops/browser.sh daemon start
marketing/ops/browser.sh open about:blank
```

2. Log in **in that Chrome window** (stay logged in; do not use Incognito):

| Service | URL |
|---|---|
| GitHub | https://github.com/login |
| Product Hunt | https://www.producthunt.com/login |
| X | https://x.com/login |
| LinkedIn | https://www.linkedin.com/login | Optional — see BROWSER.md; company page not required for v1 |
| Google (Gmail / GA / GSC) | https://accounts.google.com |
| Search Console | https://search.google.com/search-console |

3. Verify sessions stick:

```bash
marketing/ops/browser.sh open https://github.com/electrikhq
marketing/ops/browser.sh tab list
```

4. Tell the agent: **“Marketing browser is logged in.”**

## Agent preflight (every run)

```bash
marketing/ops/browser.sh status
marketing/ops/browser.sh tab list
```

If daemon is down: `marketing/ops/browser.sh daemon start` then reopen a tab.

## Backlink-pilot

Directory submits use the **same** profile:

```bash
export BB_BROWSER_HOME="$HOME/lab/electrik/.browser/electrik-marketing"
cd ~/lab/backlink-pilot
bb-browser open about:blank   # only after export, or use browser.sh from www repo
```

Prefer wrapping backlink commands:

```bash
export BB_BROWSER_HOME="/Users/neerajsohal/lab/electrik/.browser/electrik-marketing"
node src/cli.js submit ... --config config.electrik.yaml --engine bb
```

## Do not

- `pkill -f bb-browser` unless the browser is truly stuck (kills daemon; profile data is kept, but you may need to restart daemon)
- Log in via a different Chrome profile or Safari
- Clear cookies on this profile without telling the agent (sessions will break)

## Troubleshooting

| Problem | Fix |
|---|---|
| “Chrome not running” | `marketing/ops/browser.sh daemon start && marketing/ops/browser.sh open about:blank` |
| Logged out | Re-login in the marketing Chrome window only |
| Wrong profile used | Check `echo $BB_BROWSER_HOME` points at `lab/electrik/.browser/electrik-marketing` |
