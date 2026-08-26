---
title: "Quickstart"
description: "Fastest path from a fresh Laravel app to a running Electrik install."
sidebar_order: 2
sidebar_section: "Getting Started"
---

# Quickstart

Short path for a fresh Laravel 12 app. For a longer walkthrough see [Installation](/docs/getting-started/installation) or the marketing [Install](/install) page.

## Requirements

- PHP 8.3+
- Laravel 12+
- Livewire 4, Tailwind CSS v4
- Stripe test keys (for billing)

## Install

```bash
composer require electrik/electrik:^5.0
php artisan electrik:install --migrate
```

Then set Stripe keys in `.env` and sync products:

```bash
php artisan electrik:stripe:sync
php artisan storage:link
```

Optional demo data:

```bash
php artisan electrik:seed-demo
```

## Smoke-check routes

| Area | Paths |
|---|---|
| Auth | `/login`, `/register`, `/forgot-password` |
| App | `/dashboard`, `/onboarding` |
| Teams | `/teams` |
| Billing | `/billing` |
| Settings | profile, security, API tokens under settings |

## Local sandbox

From the Electrik lab monorepo:

```bash
./scripts/reset-electrik-sandbox.sh
cd electrik-sandbox
php artisan serve
```

See [Local sandbox](/docs/guides/local-sandbox).

## UI

Electrik uses Slate. Component docs: [slate.electrik.dev](https://slate.electrik.dev) — do not look for a component gallery on this site.
