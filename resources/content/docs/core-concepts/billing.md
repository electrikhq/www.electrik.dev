---
title: "Billing"
description: "Stripe via Cashier on the team, sync, webhooks, and billing UI."
sidebar_order: 5
sidebar_section: "Core Concepts"
---

# Billing

Electrik bills the **team** with Laravel Cashier.

## Setup

1. Set `STRIPE_KEY`, `STRIPE_SECRET`, `STRIPE_WEBHOOK_SECRET` in `.env`
2. Create products/prices in Stripe (test mode first)
3. Sync into Electrik:

```bash
php artisan electrik:stripe:sync
```

4. Configure Stripe webhooks to your Cashier endpoint (or Stripe CLI locally)

## App UI

`/billing` covers plans, subscribe/cancel/resume, payment methods, billing address, and invoices (subject to permissions).

## Subscription name

Cashier subscription name defaults to `electrik` (`ELECTRIK_DEFAULT_SUBSCRIPTION_NAME`).

## Require subscription

Set `ELECTRIK_REQUIRE_SUBSCRIPTION=true` to gate the app behind an active subscription (onboarding/billing routes remain reachable as configured).

## Sync subscriptions

```bash
php artisan electrik:stripe:sync-subscriptions
php artisan electrik:stripe:sync-subscriptions --team=1
```

More: [Stripe test mode](/docs/guides/stripe-test-mode).
