---
title: "API tokens"
description: "Personal vs team-scoped Sanctum tokens, abilities, and Electrik API routes."
sidebar_order: 6
sidebar_section: "Guides"
---

# API tokens

Electrik uses [Laravel Sanctum](https://laravel.com/docs/sanctum) personal access tokens. Users create and revoke tokens from **Settings → API tokens**.

## Personal vs team tokens

A token is either:

- **Personal** — scoped to the user only, no `team_id`.
- **Team** — carries a `team_id`. Requests run through `electrik.token-team`, which switches current team + Spatie context before your route runs.

Creating a team token requires `tokens.manage` (or ownership). Tokens support expiry presets (`never|7|30|90|365`) and show `last_used_at` when present.

## Abilities

Abilities come from `config('electrik.api_tokens.abilities')`. Guard routes with:

```php
Route::get('/reports', ReportsController::class)
    ->middleware('electrik.ability:read,*');
```

A token with `*` always passes. Session/web auth (no token) also passes, so the same route works for browser and API clients.

## Built-in API routes

Registered under `api` + prefix `api`:

| Method | Path | Ability |
| --- | --- | --- |
| `GET` | `/api/electrik/me` | `read` or `*` |
| `GET` | `/api/electrik/team` | `read` or `*` |
| `GET` | `/api/electrik/members` | `read` or `*` |
| `POST` | `/api/electrik/usage` | `write`, `billing:write`, or `*` |

### `/me`

Returns id, email, name, token meta (abilities, last_used_at, expires_at), and current team.

```bash
curl -H "Authorization: Bearer <token>" https://your-app.test/api/electrik/me
```

### `/usage`

Reports metered Stripe usage for the current team:

```bash
curl -X POST https://your-app.test/api/electrik/usage \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"stripe_price_id":"price_xxx","quantity":5}'
```

## Throttling

Electrik ensures `throttle:api` on the `api` group and registers a default 60/min limiter named `api` if the host app never defined one.

## OpenAPI (optional)

```bash
composer require dedoc/scramble
```

Suggested in Electrik’s `composer.json`; not required.
