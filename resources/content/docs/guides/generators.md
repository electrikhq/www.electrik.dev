---
title: "Generators"
description: "Scaffold Livewire, models, and resources with electrik:make."
sidebar_order: 5
sidebar_section: "Guides"
---

# Generators

Electrik stays in `vendor`. Product code still lives in your app. Use `electrik:make:*` to scaffold Livewire + Slate views, models, and policies without dumping the whole SaaS shell.

## Livewire

```bash
php artisan electrik:make:livewire Posts/Index
```

Creates:

- `app/Livewire/Posts/Index.php` (uses `electrik::components.layouts.app`)
- `resources/views/livewire/posts/index.blade.php` (Slate card scaffold)

## Model

```bash
php artisan electrik:make:model Post --team
```

Creates a model with `team_id` + `team()` relation and a migration. Omit `--team` for a plain model. Pass `--no-migration` to skip the migration file.

## Resource (convenience)

```bash
php artisan electrik:make:resource Post --team
```

Runs model + migration, Livewire `Post/Index` and `Post/Show`, and `app/Policies/PostPolicy.php` with permissive stubs you should tighten.

The package also ships **Studio**, a sample Clients → Projects → Tasks micro-app (see [Demo & seed-demo](/docs/getting-started/demo-seed)) so demos feel like a product. Turn it off with `ELECTRIK_SAMPLE_PROJECTS=false` once you have your own models.

## Notes

- Generated files go in the **host app**, not under `Electrik\`.
- Use `--force` to overwrite.
- Register routes and Livewire components as you normally would in Laravel.
- Full command list: [Artisan commands](/docs/reference/artisan-commands).
