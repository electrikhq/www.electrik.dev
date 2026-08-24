---
title: "Demo & seed-demo"
description: "Seed a demo user, team, and sample data for local exploration."
sidebar_order: 4
sidebar_section: "Getting Started"
---

# Demo & seed-demo

```bash
php artisan electrik:seed-demo
```

Creates a demo account and team so you can click through auth, teams, and billing without hand-assembling records.

Use this after `electrik:install` (and migrations). For Stripe-backed billing UI, still set test keys and run `electrik:stripe:sync`.

Public hosted demo: [demo.electrik.dev](https://demo.electrik.dev) — `demo@electrik.dev` / `password`.
