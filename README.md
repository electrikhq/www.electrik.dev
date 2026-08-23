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

## Pages

| Path | Purpose |
|---|---|
| `/` | Homepage |
| `/install` | Quickstart |
| `/license` | BSL dual licensing |
| `/pricing` | Grant + commercial tiers |
| `/faq` | FAQ with schema |

Legacy Slate doc URLs redirect to slate.electrik.dev.

## Remote

GitHub: [electrikhq/www](https://github.com/electrikhq/www)

Launch branch for 5.x rebuild: `launch/5x`.
