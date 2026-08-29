---
title: "Changelog"
description: "Electrik release notes and where to find full history."
sidebar_order: 4
sidebar_section: "Reference"
---

# Changelog

Electrik **5.4.0** is the current stable release. Install with:

```bash
composer require electrik/electrik:^5.4
```

## 5.4.0 (2026-08-29)

- Team brand color picker + live CSS var apply; contrast-aware primary foreground.
- Team archive/restore; optional login IP allowlist (`electrik.team-ip`).
- Session device rename; new-login email/database alerts (`ELECTRIK_LOGIN_ALERTS`).
- Apple / Microsoft Socialite (optional `socialiteproviders/*` packages).
- Stripe tax IDs; metered usage UI + `POST /api/electrik/usage`; plan add-ons (`is_addon` / `metered`).
- Outbound team webhooks (signed POST + deliveries).
- Ops: signup/MRR stubs, plan-features editor, email preview.
- API: `GET /api/electrik/team`, `GET /api/electrik/members`; token expiry / last_used on `/me`.
- Paddle remains unsupported; docs treat Stripe as the only billing path.

## 5.3.0 (2026-08-29)

- Sanctum ability catalog; `tokens.manage`; `electrik.ability` middleware.
- Auth-log filters/pagination; Checkout promotion codes; past_due dunning; Stripe webhook event log.
- Socialite Google/GitHub + magic link; operator `/ops`; announcements; team branding; `GET /api/electrik/me`.

## 5.2.0 (2026-08-27)

- MCP docs server (`@electrik/electrik-mcp`).
- GDPR personal data export + account deletion.
- Passkeys (laravel/passkeys).
- Stripe billing via `laravel/cashier` (Team); unfinished Paddle stub removed.

## 5.1.0 (2026-08-27)

- Generators: `electrik:make:livewire`, `electrik:make:model`, `electrik:make:resource`.
- Multi-persona demo seed; white-label branding env knobs.
- Member impersonation + activity filters.

## 5.0.0 (2026-08-26)

- First stable release as a Composer package on Slate 3.

Full notes: [CHANGELOG.md on GitHub](https://github.com/electrikhq/electrik/blob/5.x/CHANGELOG.md).

## Also see

- [Upgrading](/docs/guides/upgrading)
- [Roadmap](/docs/reference/roadmap)
- Packagist: [electrik/electrik](https://packagist.org/packages/electrik/electrik)
