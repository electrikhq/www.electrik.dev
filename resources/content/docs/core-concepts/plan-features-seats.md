---
title: "Plan features & seats"
description: "Gate features and member limits by Stripe price id."
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

Map each Stripe **price id** to feature flags. Unmapped prices fall back to `default`.

Use these flags in your app (and Electrik screens that already respect them, such as custom roles) to enforce plan limits. See [Feature gating](/docs/guides/feature-gating).
