---
title: "Roles & permissions"
description: "Spatie permissions with team context and the Electrik catalog."
sidebar_order: 4
sidebar_section: "Core Concepts"
---

# Roles & permissions

Electrik uses Spatie Laravel Permission in **team** context.

## Catalog keys (default)

| Permission | Category |
|---|---|
| `teams.view` | Teams |
| `teams.manage` | Teams |
| `teams.invite` | Teams |
| `teams.members` | Teams |
| `billing.view` | Billing |
| `billing.manage` | Billing |
| `access.roles` | Access |

## Role defaults

- **owner** — `*` (all)
- **admin** — teams + billing + `access.roles`
- **member** — `teams.view`, `billing.view`

## Sync

```bash
php artisan electrik:permissions:sync
```

Custom roles can be gated behind plan feature `custom_roles` — see [Plan features & seats](/docs/core-concepts/plan-features-seats). Full table: [Permissions catalog](/docs/reference/permissions-catalog).
