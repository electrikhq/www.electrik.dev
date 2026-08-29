---
title: "Roadmap"
description: "What Electrik is building next, and what we are not chasing."
sidebar_order: 5
sidebar_section: "Reference"
---

# Roadmap

Electrik **5.4.0** ships operators metrics, outbound webhooks, metered usage, add-ons, tax IDs, Apple/Microsoft Socialite hooks, and richer team settings. This page lists what is next. Dates are directional, not promises.

## Shipped recently

- **5.4** — branding picker, archive/IP allowlist, session rename, login alerts, usage/add-ons/tax IDs, outbound webhooks, ops plans + mail preview, API expansion
- **5.3** — Sanctum abilities, Socialite Google/GitHub, magic link, `/ops`, announcements, team branding, `/api/electrik/me`
- **5.2** — MCP docs, GDPR export/delete, passkeys, Stripe-only billing
- **5.1** — generators, seed-demo, impersonation, branding env knobs

## Next

1. **Hosted demo tenants** (follow-up) - Short-lived or picker-based tenants on demo.electrik.dev without requiring visitor Stripe keys. Design note: `demo.electrik.dev/HOSTED_TENANTS.md`.
2. **Install Loom** (optional marketing) - Founder-recorded walkthrough when ready.

## Explicit non-goals (for now)

- Becoming a Filament admin competitor or a hosted "Electrik Cloud" SaaS.
- Paddle or multi-processor billing — Stripe (`laravel/cashier`) only.
- Multi-database tenancy and subdomain / custom-domain mapping (separate product line if demand appears).

## How we ship

Package changes land on the `5.x` branch with [CHANGELOG](/docs/reference/changelog) entries and GitHub Releases. Marketing and docs stay on electrik.dev.

Questions or priorities: [hello@electrik.dev](mailto:hello@electrik.dev).
