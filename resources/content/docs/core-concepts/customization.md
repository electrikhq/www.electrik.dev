---
title: "Customization"
description: "Override views carefully and lean on Slate for UI."
sidebar_order: 8
sidebar_section: "Core Concepts"
---

# Customization

## Prefer config first

Most product toggles are in `config/electrik.php` and env vars. Change those before publishing or forking views.

## Views

Publish or override Electrik Blade/Livewire views only when you must. Prefer extending with your own `App\` Livewire components and routes for product-specific screens.

## Slate UI

Visual language comes from Slate. Tokens and components: [slate.electrik.dev](https://slate.electrik.dev). Do not re-implement a parallel component library inside Electrik docs or your app unless you are intentionally forking design.

## CSS

Ensure Slate is imported and `@source` includes package views (install tries to wire this). Rebuild Vite after CSS changes.
