---
title: "Feature gating"
description: "Use plan_features to limit seats and capabilities."
sidebar_order: 3
sidebar_section: "Guides"
---

# Feature gating

Define defaults and per-price overrides in `billing.plan_features` ([Plan features & seats](/docs/core-concepts/plan-features-seats)). Operators can also edit per-plan JSON + add-on/metered flags at `/ops/plans`.

Example:

```php
'by_price_id' => [
    'price_pro_monthly' => [
        'custom_roles' => true,
        'max_members' => 50,
    ],
],
```

## Helpers

```php
use Electrik\Support\PlanFeatures;

PlanFeatures::has($team, 'custom_roles');
PlanFeatures::limit($team, 'max_members');
PlanFeatures::canAddMember($team);
```

## Middleware

```php
Route::middleware('electrik.plan:custom_roles')->group(function () {
    // …
});
```

Electrik's custom roles create screen already uses this gate. Keep feature keys boring and stable — treat them as part of your product API.
