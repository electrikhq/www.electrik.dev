---
title: "Introduction"
description: "What Electrik 5.x is and how it fits a Laravel SaaS."
sidebar_order: 1
sidebar_section: "Getting Started"
---

# Introduction

Electrik is a **Laravel SaaS starter kit** shipped as a Composer package: authentication, teams, Stripe billing, onboarding, and account settings — under the `Electrik\` namespace, not copied into `App\`.

> Current package line: **5.4.0** on Laravel 12/13, Livewire 4, and [Electrik Slate](https://slate.electrik.dev) 3.

**Already on Slate?** Electrik is the SaaS shell around the same UI kit — auth, teams, Stripe on the team. [Install](/install) or try the [demo](https://demo.electrik.dev) (`demo@electrik.dev` / `password`).

![Dashboard](/images/docs/docs-dashboard.png)

## What you get

- **Auth** — login, register, verification, password reset, 2FA, passkeys, sessions, magic link, Socialite (Google / GitHub / Apple / Microsoft)
- **Teams** — create/switch, invites, roles, Spatie permissions, activity log, branding, archive, outbound webhooks, IP allowlist
- **Billing** — Laravel Cashier on the **team**, plans, add-ons, metered usage, invoices, tax IDs, payment methods, Stripe webhooks
- **Shell** — Studio dashboard (stats + activity), onboarding, sample Clients → Projects → Tasks, profile (locale + timezone), API tokens, notifications
- **Ops** — `/ops` operator console (allowlisted emails): users, teams, metrics, plan features, announcements, email preview
- **UI** — anonymous `<x-slate::*>` components and Slate tokens
- **i18n** — `en`, `es`, `fr`, `ar` (RTL), `hi`

## Package model

Unlike Jetstream-style scaffolds that dump code into your app, Electrik stays vendor-owned. You require the package, run `php artisan electrik:install`, and customize via config, published views when needed, and your own `App\` code.

That same model is why Electrik works with **Cursor / Claude / coding agents**: the shell stays a package; agents write product code in `App\` instead of forking dumped auth. See [AI & agents](/docs/getting-started/ai) and [/llms.txt](/llms.txt).

## Not included (on purpose)

- Multi-database tenancy
- Subdomain / custom-domain mapping (separate product line)
- Paddle or multi-processor billing — **Stripe only**
- Built-in “AI SaaS” product features (LLM chat, token meters) — add in `App\` if you need them

## License

Business Source License is retired for current Electrik. **5.5.0+ is MIT** — personal or commercial use without a kit license. Prefer `composer require electrik/electrik:^5.5`. Older tags may still be BSL. Paid path: [Electrik Launch](/launch).

## Next steps

1. [Quickstart](/docs/getting-started/quickstart) or the marketing [Install](/install) page
2. [Architecture](/docs/getting-started/architecture) for the teams-as-tenant mental model
3. [Configuration](/docs/core-concepts/configuration) for `config/electrik.php` and env knobs
4. [Changelog](/docs/reference/changelog) and [Roadmap](/docs/reference/roadmap)
