---
title: "Installation"
description: "What electrik:install does, flags, and post-install checklist."
sidebar_order: 3
sidebar_section: "Getting Started"
---

# Installation

## Composer

```bash
composer require electrik/electrik:^5.0@alpha
```

## Artisan install

```bash
php artisan electrik:install
# or
php artisan electrik:install --migrate --force
```

| Flag | Effect |
|---|---|
| `--force` | Overwrite published `config/electrik.php` if it exists |
| `--migrate` | Run migrations, then `electrik:permissions:sync --teams` |

### What install configures

- Publishes `config/electrik.php`
- Wires Slate CSS import / `@source` in `resources/css/app.css` when possible
- Ensures Teamwork, Spatie permission teams mode, User model traits
- Sanctum, Cashier, session driver checks
- Stripe env placeholders and webhook tip
- Suggests `storage:link` for avatars

## After install

1. Copy Stripe keys into `.env` (`STRIPE_KEY`, `STRIPE_SECRET`, `STRIPE_WEBHOOK_SECRET`)
2. `php artisan electrik:stripe:sync` — pull products/prices into Electrik tables
3. `php artisan storage:link`
4. Point Cashier webhook at your app (or use Stripe CLI locally)

## Disable features via env

| Env | Default | Purpose |
|---|---|---|
| `ELECTRIK_REGISTRATION` | `true` | Allow public registration |
| `ELECTRIK_EMAIL_VERIFICATION` | `true` | Require verified email |
| `ELECTRIK_ONBOARDING` | `true` | Force onboarding wizard |
| `ELECTRIK_REQUIRE_SUBSCRIPTION` | `false` | Gate app behind active subscription |
| `ELECTRIK_HOME` | `/dashboard` | Post-login home |

Full map: [Configuration](/docs/core-concepts/configuration).

## Optional: Slate Blocks

Curated marketing/app sections (`<x-slate-block::*>`):

```bash
composer require electrik/slate-blocks:^0.1@alpha
```

Add a Tailwind `@source` for `vendor/electrik/slate-blocks/resources/views/**/*.blade.php`. Gallery: [slate.electrik.dev/blocks](https://slate.electrik.dev/blocks).

## Agents (Cursor)

If you use Cursor, copy the **electrik-install** skill from the Electrik repo (`.cursor/skills/electrik-install`) into your project so agents install Composer packages and Blade components instead of inventing React/shadcn.
