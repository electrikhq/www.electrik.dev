---
title: "Upgrading"
description: "How to upgrade Electrik 5.x and migrate from older lines."
sidebar_order: 4
sidebar_section: "Guides"
---

# Upgrading

Electrik `5.0.0` is the first stable release on the 5.x line.

## Checklist (5.x → newer 5.x)

1. Read the package [CHANGELOG](https://github.com/electrikhq/electrik/blob/5.x/CHANGELOG.md)
2. `composer update electrik/electrik electrik/slate`
3. Re-run migrations if new ones shipped
4. `php artisan electrik:permissions:sync` if the catalog changed
5. `php artisan electrik:stripe:sync` if billing models changed
6. Diff `config/electrik.php` against the published stub (`electrik:install --force` only if you understand the overwrite)

Prefer a pinned version in production (`5.0.0`) or a caret range (`^5.0`) over historical `@alpha` constraints.

## From 5.0.0-alpha.* → 5.0.0

```bash
composer require electrik/electrik:^5.0 electrik/slate:^3.0
php artisan migrate
php artisan electrik:permissions:sync --teams
php artisan electrik:stripe:sync
```

Review the CHANGELOG entries between your alpha pin and `5.0.0` for any config or view overrides you published.

## 4.x → 5.x

5.x is a new stack (Laravel 12, Slate 3, Livewire 4, package-first). Treat migration as a **re-install** onto a fresh app rather than an in-place upgrade from Electrik 4, unless you have a dedicated migration plan.
