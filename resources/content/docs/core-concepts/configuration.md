---
title: "Configuration"
description: "config/electrik.php and environment variables."
sidebar_order: 1
sidebar_section: "Core Concepts"
---

# Configuration

Published file: `config/electrik.php`.

## Branding (app-level white-label)

```php
'name' => env('ELECTRIK_NAME', 'Electrik'),

'branding' => [
    'logo_url' => env('ELECTRIK_LOGO_URL'),
    'logo_dark_url' => env('ELECTRIK_LOGO_DARK_URL'),
    'primary' => env('ELECTRIK_BRAND_PRIMARY'), // CSS color for --slate-primary
    'show_powered_by' => filter_var(env('ELECTRIK_SHOW_POWERED_BY', true), FILTER_VALIDATE_BOOL),
],
```

Per-team branding (logo + primary color) is set in **Teams → Settings** and overrides the app primary for that team's shell.

## Auth

```php
'auth' => [
    'home' => env('ELECTRIK_HOME', '/dashboard'),
    'registration' => env('ELECTRIK_REGISTRATION', true),
    'email_verification' => env('ELECTRIK_EMAIL_VERIFICATION', true),
    'socialite' => [
        'providers' => /* ELECTRIK_SOCIALITE_PROVIDERS, default google,github */,
    ],
    'magic_link' => [
        'enabled' => env('ELECTRIK_MAGIC_LINK', true),
        'expire_minutes' => env('ELECTRIK_MAGIC_LINK_EXPIRE', 15),
    ],
    'login_alerts' => env('ELECTRIK_LOGIN_ALERTS', true),
],
```

Supported Socialite keys: `google`, `github`, `apple`, `microsoft`. Apple/Microsoft need optional Composer packages — see [Social login & magic link](/docs/guides/social-login).

## Operators

```php
'operators' => [
    'emails' => /* ELECTRIK_OPERATOR_EMAILS comma list */,
],
```

Only listed emails can open `/ops`. See [Operator console](/docs/guides/operators-ops).

## Locales

```php
'locales' => ['en', 'es', 'fr', 'ar', 'hi'],
```

User Profile language wins; guests use `APP_LOCALE`. See [Internationalization](/docs/guides/i18n).

## Teams

```php
'teams' => [
    'roles' => ['owner', 'admin', 'member'],
    'invite_expires_days' => (int) env('ELECTRIK_INVITE_EXPIRES_DAYS', 7),
],
```

## Permissions catalog

`permissions.catalog` and `permissions.role_permissions` define Spatie team-scoped permissions. Sync after changes:

```bash
php artisan electrik:permissions:sync
```

## API tokens

```php
'api_tokens' => [
    'default_expiration_days' => env('ELECTRIK_API_TOKEN_EXPIRATION_DAYS', '90'),
    'abilities' => [ '*' => 'Full access', 'read' => 'Read', /* ... */ ],
],
```

## Billing

```php
'billing' => [
    'driver' => env('ELECTRIK_BILLING_DRIVER', 'stripe'), // stripe only
    'subscription_name' => env('ELECTRIK_DEFAULT_SUBSCRIPTION_NAME', 'electrik'),
    'cc_required_for_free_plan' => env('ELECTRIK_CC_REQUIRED_FOR_FREE_PLAN', false),
    'require_subscription' => filter_var(env('ELECTRIK_REQUIRE_SUBSCRIPTION', false), FILTER_VALIDATE_BOOL),
    'plan_features' => [
        'default' => ['custom_roles' => false, 'max_members' => 5],
        'by_price_id' => [ /* 'price_xxx' => [...] */ ],
    ],
],
```

Cashier stores the subscription type in the `type` column (value defaults to `electrik`). See [Billing](/docs/core-concepts/billing) and [Plan features & seats](/docs/core-concepts/plan-features-seats).

## Sample resources

```php
'sample' => [
    'projects' => env('ELECTRIK_SAMPLE_PROJECTS', true),
],
```

When enabled (default), Electrik registers the sample **Studio** micro-app: `/clients`, `/projects`, and project task boards. Set `ELECTRIK_SAMPLE_PROJECTS=false` once you ship your own models.
