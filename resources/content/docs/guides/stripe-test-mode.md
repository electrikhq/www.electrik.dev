---
title: "Stripe test mode"
description: "Develop billing against Stripe test keys and the Stripe CLI."
sidebar_order: 2
sidebar_section: "Guides"
---

# Stripe test mode

1. Create a Stripe test-mode account / use test keys
2. Put `STRIPE_KEY`, `STRIPE_SECRET`, and `STRIPE_WEBHOOK_SECRET` in `.env`
3. Create products and recurring prices in the Stripe Dashboard (test mode)
4. Sync:

```bash
php artisan electrik:stripe:sync
```

5. Forward webhooks locally:

```bash
stripe listen --forward-to localhost:8000/stripe/webhook
```

(Use the Cashier webhook path your app exposes.)

Never use live keys in local sandboxes. Map price ids to plan features in `config/electrik.php`.
