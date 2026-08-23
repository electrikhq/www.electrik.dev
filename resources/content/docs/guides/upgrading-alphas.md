---
title: "Upgrading alphas"
description: "How to move between Electrik 5.x alpha releases safely."
sidebar_order: 4
sidebar_section: "Guides"
---

# Upgrading alphas

Electrik 5.x is **alpha**. Expect breaking changes between tags.

## Checklist

1. Read the package [CHANGELOG](https://github.com/electrikhq/electrik/blob/5.x/CHANGELOG.md)
2. `composer update electrik/electrik electrik/slate`
3. Re-run migrations if new ones shipped
4. `php artisan electrik:permissions:sync` if the catalog changed
5. `php artisan electrik:stripe:sync` if billing models changed
6. Diff `config/electrik.php` against the published stub (`electrik:install --force` only if you understand the overwrite)

Pin a specific alpha in production experiments (`5.0.0-alpha.14`) rather than floating `@alpha` if you need reproducibility.

## 4.x → 5.x

5.x is a new stack (Laravel 12, Slate 3, Livewire 4, package-first). Treat migration as a **re-install** onto a fresh app rather than an in-place upgrade from Electrik 4, unless you have a dedicated migration plan.
