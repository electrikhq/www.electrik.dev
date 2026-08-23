# www.electrik.dev

Marketing site for [electrik.dev](https://electrik.dev), the Electrik Laravel SaaS starter kit (5.x).

| Site | Repo | Purpose |
|---|---|---|
| [electrik.dev](https://electrik.dev) | **this repo** | Product marketing, install, license, pricing |
| [slate.electrik.dev](https://slate.electrik.dev) | `slate.electrik.dev` | Slate 3 UI kit docs |
| [demo.electrik.dev](https://demo.electrik.dev) | — | Hosted demo app |

## Stack

- Laravel 12
- Electrik Slate 3 (`electrik/slate`)
- Tailwind CSS v4 via `@tailwindcss/vite`
- Static export with `spatie/laravel-export`

## Development

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
composer dev   # or: php artisan serve + npm run dev
```

Path-repo Slate from the lab monorepo is wired via `composer.local.json` (`../slate`).

## Production build

```bash
npm run build
# vite build + php artisan export → dist/
```

Set `APP_PRODUCTION_URL=https://electrik.dev` before export so canonical URLs, sitemap, and OG tags point at production.

## Deploy

Push to `master` (or **Actions → Deploy to Cloudflare Pages → Run workflow**).

GitHub Actions builds the static site and deploys to Cloudflare Pages. Secrets and details: [`.github/workflows/README.md`](.github/workflows/README.md).

## Pages

| Path | Purpose |
|---|---|
| `/` | Homepage |
| `/install` | Quickstart |
| `/license` | BSL dual licensing |
| `/pricing` | Grant + commercial tiers |
| `/faq` | FAQ with schema |
| `/contact` | Studio / project inquiries |

Legacy Slate doc URLs redirect to slate.electrik.dev.

## Remote

GitHub: [electrikhq/www.electrik.dev](https://github.com/electrikhq/www.electrik.dev)

Work on **`master` only**.
