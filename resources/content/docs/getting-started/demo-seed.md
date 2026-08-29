---
title: "Demo & seed-demo"
description: "Seed demo personas and the sample Studio micro-SaaS (clients, projects, tasks)."
sidebar_order: 4
sidebar_section: "Getting Started"
---

# Demo & seed-demo

```bash
php artisan electrik:seed-demo
```

Creates demo accounts, teams, and a sample **Studio** micro-app so you can click through a real product shape on top of Electrik’s shell (auth, teams, billing, ops).

| Email | Password | Role | Teams |
| --- | --- | --- | --- |
| `demo@electrik.dev` | `password` | owner | Demo Team, Acme Team |
| `admin@electrik.dev` | `password` | admin | Demo Team |
| `member@electrik.dev` | `password` | member | Demo Team |

## Sample Studio

After seed, open:

| Path | What |
| --- | --- |
| `/dashboard` | Studio overview: clients, open/overdue tasks, my work |
| `/clients` | Accounts you deliver for |
| `/projects` | Delivery containers linked to clients |
| `/projects/{id}` | Tasks with assignee, priority, status |

Studio is **demo meat**: a replaceable Clients → Projects → Tasks product. Keep it, fork it, or turn it off with `ELECTRIK_SAMPLE_PROJECTS=false`. Build your own with `electrik:make:resource`.

Use `--force` to reset passwords if the users already exist. After `electrik:install` (and migrations). For Stripe-backed billing UI, still set test keys and run `electrik:stripe:sync`.

Public hosted demo: [demo.electrik.dev](https://demo.electrik.dev) with the same personas.
