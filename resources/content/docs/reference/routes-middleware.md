---
title: "Routes & middleware"
description: "High-level route groups Electrik registers."
sidebar_order: 2
sidebar_section: "Reference"
---

# Routes & middleware

Electrik registers route files for auth, app shell, teams, billing, and settings.

## Common paths

| Area | Examples |
|---|---|
| Auth | `/login`, `/register`, `/forgot-password`, verification |
| App | `/dashboard`, `/onboarding` |
| Teams | `/teams`, invitations accept/deny |
| Billing | `/billing` and related Livewire screens |
| Settings | profile, security (password/2FA/sessions), API tokens |

Exact paths can evolve in alpha — use `php artisan route:list --path=...` in your app after install.

## Middleware themes

- Authenticate + verified (when enabled)
- Team selection / current team context
- Onboarding gate
- Optional subscription requirement

Customize by toggling config/env first; add your own middleware in `App\` for product-specific rules.
