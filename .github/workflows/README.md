# Deploy (GitHub Actions → Cloudflare Pages)

Same model as slate.electrik.dev: push to `master` (or run the workflow manually). No local Wrangler.

## Required GitHub secrets

Repo → **Settings → Secrets and variables → Actions**:

| Secret | Purpose |
|---|---|
| `CLOUDFLARE_API_TOKEN` | Token with Cloudflare Pages Edit |
| `CLOUDFLARE_ACCOUNT_ID` | Cloudflare account id |
| `CLOUDFLARE_PROJECT_NAME` | Existing Pages project name for electrik.dev |

Optional: `APP_URL` (defaults to `https://electrik.dev`).

## What the workflow does

1. `composer install` (Packagist Slate; `composer.local.json` removed on CI)
2. `npm ci` + `vite build`
3. Start Laravel, `php artisan export` → `dist/`
4. `wrangler pages deploy dist` via `cloudflare/wrangler-action` (in Actions only)

## After first successful run

Confirm custom domain `electrik.dev` is attached to that Pages project in the Cloudflare dashboard.
