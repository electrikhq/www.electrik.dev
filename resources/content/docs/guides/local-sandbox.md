---
title: "Local sandbox"
description: "Reset and run the Electrik sandbox app from the lab monorepo."
sidebar_order: 1
sidebar_section: "Guides"
---

# Local sandbox

From the Electrik lab workspace root:

```bash
./scripts/reset-electrik-sandbox.sh
cd electrik-sandbox
php artisan serve
```

The script wipes `electrik-sandbox/`, creates a fresh Laravel app, path-links local `electrik` + `slate`, runs `electrik:install`, and builds assets.

Useful smoke paths: `/login`, `/register`, `/billing` (with Stripe test keys + `electrik:stripe:sync`).
