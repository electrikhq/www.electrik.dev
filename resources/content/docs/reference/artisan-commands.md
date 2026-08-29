---
title: "Artisan commands"
description: "Electrik console commands reference."
sidebar_order: 1
sidebar_section: "Reference"
---

# Artisan commands

| Command | Purpose |
|---|---|
| `electrik:install` | Publish config and wire dependencies (`--force`, `--migrate`) |
| `electrik:seed-demo` | Seed demo user/team data |
| `electrik:make:livewire {Name}` | Livewire class + Slate Blade view (`--force`) |
| `electrik:make:model {Name}` | Model + migration (`--team`, `--no-migration`, `--force`) |
| `electrik:make:resource {Name}` | Model, migration, Livewire Index/Show, policy stub (`--team`, `--force`) |
| `electrik:permissions:sync` | Sync Spatie permissions/roles from catalog |
| `electrik:stripe:sync` | Sync Stripe products/prices into Electrik tables |
| `electrik:stripe:sync-subscriptions` | Sync Cashier subscriptions (`--team=`) |
| `electrik:onboarding:skip-existing` | Mark existing users as onboarded |
| `electrik:onboarding:reset` | Reset onboarding state for testing |

Also remember Laravel/Cashier standards: `migrate`, `storage:link`, queue workers for webhooks if you dispatch jobs.

See [Generators](/docs/guides/generators) for `electrik:make:*` examples.
