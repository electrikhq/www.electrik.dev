---
title: "Billing providers"
description: "Stripe Cashier is the supported billing processor."
sidebar_order: 8
sidebar_section: "Guides"
---

# Billing providers

Electrik bills on the **Team** model via **Stripe** and `laravel/cashier`.

```env
ELECTRIK_BILLING_DRIVER=stripe
```

Only `stripe` is supported. Other values throw at runtime.

```php
use Electrik\Support\Billing\Billing;

$driver = Billing::driver(); // StripeBillingDriver
```

Paddle is not supported. Stripe remains the only commercial path.

## Related

- [Billing](/docs/core-concepts/billing)
- [Stripe test mode](/docs/guides/stripe-test-mode)
