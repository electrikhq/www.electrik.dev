---
title: "Billing"
description: "Stripe via Cashier on the team: plans, add-ons, usage, tax IDs, webhooks."
sidebar_order: 5
sidebar_section: "Core Concepts"
---

# Billing

Electrik bills the **team** with Laravel Cashier. Only the **Stripe** driver is supported.

![Billing overview](/images/docs/docs-billing.png)

## Setup

1. Set `STRIPE_KEY`, `STRIPE_SECRET`, `STRIPE_WEBHOOK_SECRET` in `.env`
2. Create products/prices in Stripe (test mode first)
3. Sync into Electrik:

```bash
php artisan electrik:stripe:sync
```

4. Point Stripe webhooks at your Cashier endpoint (or Stripe CLI locally)

## App UI (`/billing`)

| Screen | Purpose |
| --- | --- |
| Overview | Current subscription summary |
| Plans | Base plans + add-ons |
| Subscription | Cancel / resume / manage |
| Payment methods | Cards via Cashier |
| Address | Customer address + **tax IDs** |
| Invoices | Past invoices |
| Usage | Report metered usage |

Checkout supports Stripe promotion codes. Past-due / unpaid subscriptions show a dunning banner and ops notifications.

## Subscription type

Cashier 15 stores the subscription key in the `type` column (not legacy `name`). Default value: `electrik` (`ELECTRIK_DEFAULT_SUBSCRIPTION_NAME`).

## Add-ons

Mark a synced plan as an add-on in **Ops → Plan features** (`is_addon`). On Plans, add-ons attach to an existing active subscription via Cashier `addPrice`.

## Metered usage

Mark a plan `metered` in Ops. Teams report quantity from **Billing → Usage** or:

```bash
curl -X POST https://your-app.test/api/electrik/usage \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"stripe_price_id":"price_xxx","quantity":10}'
```

## Tax IDs

**Billing → Address** can create/delete Stripe customer tax IDs (EU VAT, US EIN, GB VAT, etc.).

## Require subscription

`ELECTRIK_REQUIRE_SUBSCRIPTION=true` gates the app behind an active subscription (onboarding/billing routes remain reachable as configured).

## Sync subscriptions

```bash
php artisan electrik:stripe:sync-subscriptions
php artisan electrik:stripe:sync-subscriptions --team=1
```

More: [Stripe test mode](/docs/guides/stripe-test-mode), [Billing providers](/docs/guides/billing-providers), [Plan features & seats](/docs/core-concepts/plan-features-seats).
