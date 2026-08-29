---
title: "Teams & invites"
description: "Create and switch teams, branding, archive, invites, ownership, activity, webhooks."
sidebar_order: 3
sidebar_section: "Core Concepts"
---

# Teams & invites

Teams are the workspace unit in Electrik. Billing and many permissions attach to the **current team**.

![Teams](/images/docs/docs-teams.png)

## Capabilities

- Create and switch teams
- Team settings: name, avatar, branding, IP allowlist, archive/restore, delete
- Invite members by email (`ELECTRIK_INVITE_EXPIRES_DAYS`, default 7)
- Accept / deny invitations
- Manage members, roles, leave team, transfer ownership
- Impersonate members (`users.impersonate` via lab404/laravel-impersonate)
- Activity log (filterable, paginated)
- Outbound webhooks (signed HTTP deliveries)

![Members](/images/docs/docs-members.png)

## Branding

![Team settings](/images/docs/docs-team-settings.png)

Under **Teams → Settings → Branding**:

- Brand logo (public disk)
- Primary color (native color picker + hex)

Saved colors update `--slate-primary` / `--color-primary` (and contrast-aware foreground) for that team's shell without a full reload.

## Archive vs delete

- **Archive** — hides the team from the switcher; restore later
- **Delete** — cancels billing, removes members/roles (owner only)

## Activity

![Activity](/images/docs/docs-activity.png)

Team events (invites, joins, branding, ownership, webhooks, archive, etc.) are stored via Spatie activitylog with `team_id`.

## Outbound webhooks

**Teams → Webhooks** registers HTTPS endpoints. Electrik POSTs signed JSON (`X-Electrik-Signature`) for events such as `team.archived`, `team.deleted`. See [Outbound webhooks](/docs/guides/outbound-webhooks).

## Default roles

Configured in `config/electrik.php`: `owner`, `admin`, `member`. See [Roles & permissions](/docs/core-concepts/roles-permissions).

Teams engine: `electrik/teamwork` (Electrik’s Teamwork fork).
