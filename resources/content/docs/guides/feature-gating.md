---
title: "Feature gating"
description: "Use plan_features to limit seats and capabilities."
sidebar_order: 3
sidebar_section: "Guides"
---

# Feature gating

Define defaults and per-price overrides in `billing.plan_features` ([Plan features & seats](/docs/core-concepts/plan-features-seats)).

Example:

```php
'by_price_id' => [
    'price_pro_monthly' => [
        'custom_roles' => true,
        'max_members' => 50,
    ],
],
```

In your application code, resolve the current team's subscription price and read the matching feature bag (falling back to `default`). Electrik's roles UI already respects `custom_roles` where implemented.

Keep feature keys boring and stable — treat them as part of your product API.
