---
title: "Introduction"
description: "What Electrik 5.x is and how it fits a Laravel SaaS."
sidebar_order: 1
sidebar_section: "Getting Started"
---

# Introduction

Electrik is a **Laravel SaaS starter kit** shipped as a Composer package: authentication, teams, Stripe billing, onboarding, and account settings — under the `Electrik\` namespace, not copied into `App\`.

> **Alpha.** APIs can change. Current package line: `5.0.0-alpha.15` on Laravel 12, Livewire 4, and [Electrik Slate](https://slate.electrik.dev) 3.

**Already on Slate?** Electrik is the SaaS shell around the same UI kit — auth, teams, Stripe on the team. [Install](/install) or try the [demo](https://demo.electrik.dev).

## What you get

- Auth: login, register, verification, password reset, remember me, 2FA, sessions
- Teams: create/switch, invites, roles, Spatie permissions (team-scoped)
- Billing: Laravel Cashier on the **team**, plans, invoices, payment methods, webhooks
- Shell: dashboard, onboarding wizard, profile, API tokens, notifications, activity log
- UI: anonymous `<x-slate::*>` components and Slate tokens (docs live on slate.electrik.dev)

## Package model

Unlike Jetstream-style scaffolds that dump code into your app, Electrik stays vendor-owned. You require the package, run `php artisan electrik:install`, and customize via config, published views when needed, and your own `App\` code.

## License

Business Source License 1.1 with a free Additional Use Grant for personal, educational, open-source, and pre-revenue indie use. Commercial products and client work need a [commercial license](/license).

## Next steps

1. [Quickstart](/docs/getting-started/quickstart) or the marketing [Install](/install) page
2. [Architecture](/docs/getting-started/architecture) for the teams-as-tenant mental model
3. [Configuration](/docs/core-concepts/configuration) for `config/electrik.php` and env knobs
