---
title: "Plan features & seats"
description: "Gate features and member limits by Stripe price; ops editor for flags and add-ons."
sidebar_order: 6
sidebar_section: "Core Concepts"
---

# Plan features & seats

`config/electrik.php` → `billing.plan_features`:

```php
'plan_features' => [
    'default' => [
        'custom_roles' => false,
        'max_members' => 5,
    ],
    'by_price_id' => [
        // 'price_xxx' => ['custom_roles' => true, 'max_members' => 50],
    ],
],
```

Runtime merge order: **defaults → by_price_id → plan `features` JSON**.

Seat-billed plans with `max_seats` also feed `max_members` when features omit it (`PlanFeatures`).

## Ops editor

Operators can edit each synced plan's features JSON plus **Add-on** and **Metered** flags at `/ops/plans` without hand-editing the database.

Use `electrik.plan:custom_roles` (and your own feature keys) with the `EnsurePlanFeature` middleware. See [Feature gating](/docs/guides/feature-gating).
