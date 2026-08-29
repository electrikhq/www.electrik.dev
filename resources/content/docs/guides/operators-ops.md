---
title: "Operator console"
description: "ELECTRIK_OPERATOR_EMAILS and the /ops Slate console."
sidebar_order: 7
sidebar_section: "Guides"
---

# Operator console

Electrik ships a platform ops UI at `/ops` for allowlisted emails — not Filament.

![Operations](/images/docs/docs-ops.png)

## Access

```env
ELECTRIK_OPERATOR_EMAILS=you@example.com,ops@example.com
```

Middleware: `electrik.operator` (`EnsureOperator`). Non-operators get 403.

## Screens

| Path | Purpose |
| --- | --- |
| `/ops` | Metrics: users, teams, past due, failed jobs, signups 7d/30d, active subs, est. MRR stub |
| `/ops/users` | Search, suspend, impersonate |
| `/ops/teams` | Team list |
| `/ops/webhooks` | Inbound Stripe webhook event log |
| `/ops/plans` | Edit plan features JSON, add-on / metered flags |
| `/ops/failed-jobs` | Failed queue jobs |
| `/ops/announcements` | CRUD + publish fan-out |
| `/ops/mail-preview` | Preview package notification emails |

![Email preview](/images/docs/docs-mail-preview.png)

## Est. MRR

Ops MRR is a **local catalog stub** (plan prices × active subscription items). It is not Stripe Reporting. Cashier uses the `type` column for subscription name filtering.

## Impersonation

Ops (and team members UI) can impersonate via `lab404/laravel-impersonate`. A banner + leave route stop impersonation; activity is logged.
