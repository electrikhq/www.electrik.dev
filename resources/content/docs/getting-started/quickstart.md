---
title: "Quickstart"
description: "Fastest path from a fresh Laravel app to a running Electrik install."
sidebar_order: 2
sidebar_section: "Getting Started"
---

# Quickstart

Short path for a fresh Laravel 12/13 app. For a longer walkthrough see [Installation](/docs/getting-started/installation) or the marketing [Install](/install) page.

![Login](/images/docs/docs-login.png)

## Requirements

- PHP 8.3+
- Laravel 12+ or 13+
- Livewire 4, Tailwind CSS v4
- Stripe test keys (for billing)

## Install

```bash
composer require electrik/electrik:^5.4
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

For the operator console, set:

```env
ELECTRIK_OPERATOR_EMAILS=demo@electrik.dev
```

## Smoke-check routes

| Area | Paths |
|---|---|
| Auth | `/login`, `/register`, `/forgot-password` |
| App | `/dashboard`, `/onboarding` |
| Teams | `/teams`, settings, members, activity, webhooks |
| Billing | `/billing`, plans, address, usage |
| Settings | profile, security, sessions, API tokens |
| Ops | `/ops` (operator emails only) |

![Dashboard](/images/docs/docs-dashboard.png)

## Local sandbox

From the Electrik lab monorepo:

```bash
./scripts/reset-electrik-sandbox.sh
cd electrik-sandbox
composer dev
```

See [Local sandbox](/docs/guides/local-sandbox).

## UI

Electrik uses Slate. Component docs: [slate.electrik.dev](https://slate.electrik.dev).
