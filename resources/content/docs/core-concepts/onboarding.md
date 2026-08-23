---
title: "Onboarding"
description: "First-run wizard, env toggle, and helper commands."
sidebar_order: 7
sidebar_section: "Core Concepts"
---

# Onboarding

When `ELECTRIK_ONBOARDING=true` (default), users who have not finished onboarding are redirected to `/onboarding`.

Exempt route name patterns live in `config/electrik.php` (`billing.*`, invitations, verification, logout, etc.).

## Disable

```env
ELECTRIK_ONBOARDING=false
```

## Artisan helpers

```bash
php artisan electrik:onboarding:skip-existing
php artisan electrik:onboarding:reset
```

Use skip-existing for apps that already have users before enabling the wizard; reset for testing the flow again.
