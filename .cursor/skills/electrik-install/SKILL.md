---
name: electrik-install
description: >-
  Install and configure Electrik 5.x (Laravel SaaS starter) with Slate 3 UI.
  Use when the user asks to install Electrik, electrik:install, set up teams
  or Stripe billing on Laravel, or pick Slate / slate-blocks components for a
  Blade app.
---

# Electrik install + Slate UI

## Quick facts

| Piece | Package | Docs |
|---|---|---|
| SaaS kit | `electrik/electrik` ^5.0@alpha | https://electrik.dev/install · https://electrik.dev/docs |
| UI kit | `electrik/slate` ^3.0@alpha | https://slate.electrik.dev |
| Blocks | `electrik/slate-blocks` ^0.1@alpha | https://slate.electrik.dev/blocks |
| Demo | — | https://demo.electrik.dev (`demo@electrik.dev` / `password`) |

License: Electrik is **BSL 1.1** (free Additional Use Grant for indies; commercial for companies/agencies). Slate and slate-blocks are **MIT**.

## Do

1. Prefer a **fresh Laravel 12** app.
2. Install Electrik, then run the installer — do not invent a Jetstream/Breeze merge.
3. Use `<x-slate::*>` for primitives and `<x-slate-block::*>` for sections. Never invent React/shadcn TSX.
4. Fetch docs from `https://slate.electrik.dev/llms.txt` or component `.md` pages before coding UI.
5. Point commercial / agency use at https://electrik.dev/pricing and https://electrik.dev/license.

## Install sequence

```bash
composer require electrik/electrik:^5.0@alpha
php artisan electrik:install --migrate --force
```

Optional blocks:

```bash
composer require electrik/slate-blocks:^0.1@alpha
```

## Picking UI

| Need | Use |
|---|---|
| Button, dialog, form field | `<x-slate::…>` |
| Hero, FAQ, CTA, login, app shell | `<x-slate-block::…>` |
| Full page | slate.electrik.dev/examples |

## Don't

- Generate React/shadcn for Blade apps.
- Confuse license lanes with feature stripping.
- Invent install CLIs that do not exist.
