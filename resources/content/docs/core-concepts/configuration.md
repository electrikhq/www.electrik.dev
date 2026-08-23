---
title: "Configuration"
description: "config/electrik.php and environment variables."
sidebar_order: 1
sidebar_section: "Core Concepts"
---

# Configuration

Published file: `config/electrik.php`.

## Auth

```php
'auth' => [
    'home' => env('ELECTRIK_HOME', '/dashboard'),
    'registration' => env('ELECTRIK_REGISTRATION', true),
    'email_verification' => env('ELECTRIK_EMAIL_VERIFICATION', true),
],
```

## Onboarding

```php
'onboarding' => [
    'enabled' => filter_var(env('ELECTRIK_ONBOARDING', true), FILTER_VALIDATE_BOOL),
    'exempt_routes' => [/* onboarding, billing.*, teams.invitations.*, verification.*, logout */],
],
```

## Teams

```php
'teams' => [
    'roles' => ['owner', 'admin', 'member'],
    'invite_expires_days' => (int) env('ELECTRIK_INVITE_EXPIRES_DAYS', 7),
],
```

## Permissions catalog

`permissions.catalog` defines permission keys, display names, and categories. `permissions.role_permissions` maps owner/admin/member to those keys (`owner` => `*`).

Sync after catalog changes:

```bash
php artisan electrik:permissions:sync
```

## Billing

```php
'billing' => [
    'subscription_name' => env('ELECTRIK_DEFAULT_SUBSCRIPTION_NAME', 'electrik'),
    'cc_required_for_free_plan' => env('ELECTRIK_CC_REQUIRED_FOR_FREE_PLAN', false),
    'require_subscription' => filter_var(env('ELECTRIK_REQUIRE_SUBSCRIPTION', false), FILTER_VALIDATE_BOOL),
    'plan_features' => [
        'default' => ['custom_roles' => false, 'max_members' => 5],
        'by_price_id' => [ /* 'price_xxx' => [...] */ ],
    ],
],
```

See [Plan features & seats](/docs/core-concepts/plan-features-seats) and [Billing](/docs/core-concepts/billing).
