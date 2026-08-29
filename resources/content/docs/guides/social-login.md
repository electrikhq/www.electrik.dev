---
title: "Social login & magic link"
description: "Google, GitHub, Apple, Microsoft Socialite and magic-link email sign-in."
sidebar_order: 8
sidebar_section: "Guides"
---

# Social login & magic link

## Magic link

Enabled by default (`ELECTRIK_MAGIC_LINK=true`). Login page offers “Email me a link”; tokens expire after `ELECTRIK_MAGIC_LINK_EXPIRE` minutes (default 15).

## Socialite providers

```env
ELECTRIK_SOCIALITE_PROVIDERS=google,github
# optional:
# ELECTRIK_SOCIALITE_PROVIDERS=google,github,apple,microsoft
```

Configure each provider’s client id/secret in `config/services.php` as usual for Laravel Socialite.

### Google & GitHub

Built into `laravel/socialite` — no extra packages.

### Apple & Microsoft

Optional packages (suggested in Electrik’s `composer.json`):

```bash
composer require socialiteproviders/apple socialiteproviders/microsoft
```

Electrik registers `SocialiteWasCalled` extenders when those classes exist. Without the packages, enabling `apple` / `microsoft` in env returns 503 with a clear message.

## User columns

Install migrations add `provider` / `provider_id` on users when present. Existing email accounts link on first social login if columns are empty.

## Registration off

If `ELECTRIK_REGISTRATION=false`, social login only works for existing users (same as password login for unknown emails).
