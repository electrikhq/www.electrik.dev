---
title: "Architecture"
description: "Package vs App, teams as tenant, middleware, and Slate shell."
sidebar_order: 5
sidebar_section: "Getting Started"
---

# Architecture

## Package vs application

Electrik code lives under `vendor/electrik/electrik` in the `Electrik\` namespace. Your product code stays in `App\`. Prefer config and composition over forking package classes.

## Teams as tenant

Billing, seats, and many permissions are scoped to the **current team**, not only the user. Cashier billable is the team. Switching teams switches workspace context.

## Request stack (mental model)

Typical authenticated flow:

1. Auth middleware
2. Email verification (if enabled)
3. Team selected (`EnsureTeamSelected` and related)
4. Onboarding incomplete → `/onboarding` (unless exempt)
5. Optional subscription requirement → billing

Exempt onboarding routes are listed in `config/electrik.php` under `onboarding.exempt_routes` (billing, invitations, verification, logout).

## UI shell

Screens use Slate anonymous components (`<x-slate::*>`) and Slate design tokens. Customize carefully; deep UI reference stays on [slate.electrik.dev](https://slate.electrik.dev).

## Related packages

- `electrik/slate` — UI kit
- `electrik/teamwork` — Electrik fork of Teamwork (teams engine)
- `spatie/laravel-permission` — roles/permissions with teams
- `laravel/cashier` — Stripe subscriptions
