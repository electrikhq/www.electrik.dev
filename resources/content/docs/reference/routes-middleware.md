---
title: "Routes & middleware"
description: "Route groups and middleware aliases Electrik registers."
sidebar_order: 2
sidebar_section: "Reference"
---

# Routes & middleware

Electrik registers route files for auth, app shell, teams, billing, settings, ops, and API.

## Common paths

| Area | Examples |
|---|---|
| Auth | `/login`, `/register`, magic link, Socialite callbacks |
| App | `/dashboard`, `/onboarding`, `/clients`, `/projects` (sample Studio), `/pricing` |
| Teams | `/teams`, `/teams/{team}/settings`, members, roles, activity, webhooks |
| Billing | `/billing`, plans, subscription, address, invoices, **usage** |
| Settings | profile, security, sessions, API tokens |
| API | `/api/electrik/me`, `/team`, `/members`, `POST /usage` |
| Ops | `/ops`, users, teams, webhooks, plans, failed jobs, announcements, mail-preview |

Exact paths can evolve between minors. Use `php artisan route:list` after install.

## Middleware aliases

| Alias | Role |
|---|---|
| `electrik.locale` | Set locale from user / `APP_LOCALE` |
| `electrik.plan` | Require plan feature (`electrik.plan:custom_roles`) |
| `electrik.token-team` | Bind team from Sanctum token |
| `electrik.ability` | Require Sanctum ability |
| `electrik.operator` | Restrict to `ELECTRIK_OPERATOR_EMAILS` |
| `electrik.team-ip` | Enforce team IP allowlist |

Also used on route groups: team selected, onboarding complete, subscription active (when required).

Customize by toggling config/env first; add product middleware in `App\`.
