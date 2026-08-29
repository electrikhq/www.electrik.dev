---
title: "Upgrading"
description: "How to upgrade Electrik 5.x and migrate from older lines."
sidebar_order: 4
sidebar_section: "Guides"
---

# Upgrading

Electrik `5.4.0` is the current stable on the 5.x line.

## Checklist (5.x → newer 5.x)

1. Read the package [CHANGELOG](https://github.com/electrikhq/electrik/blob/5.x/CHANGELOG.md)
2. `composer update electrik/electrik electrik/slate`
3. Re-run migrations if new ones shipped (`php artisan migrate`)
4. `php artisan electrik:permissions:sync` if the catalog changed
5. `php artisan electrik:stripe:sync` if billing models changed
6. Diff `config/electrik.php` against the published stub (`electrik:install --force` only if you understand the overwrite)

Prefer a caret range (`^5.4`) or an exact pin in production.

## 5.3 → 5.4

Notable new migrations:

- `archived_at` / `allowed_ips` on teams
- `session_labels`
- `team_webhooks` + `team_webhook_deliveries`
- `is_addon` / `metered` on `stripe_plans`

New config knobs: `auth.login_alerts`, Socialite may include `apple,microsoft`, ops routes for plans + mail preview.

Cashier subscription type column is `type` (not legacy `name`). Ops metrics already handle both.

## 5.0.0-alpha.* → 5.x

```bash
composer require electrik/electrik:^5.4 electrik/slate:^3.0
php artisan migrate
php artisan electrik:permissions:sync --teams
php artisan electrik:stripe:sync
```

## 4.x → 5.x

5.x is a new stack (Laravel 12+, Slate 3, Livewire 4, package-first). Treat migration as a **re-install** onto a fresh app rather than an in-place upgrade from Electrik 4.
