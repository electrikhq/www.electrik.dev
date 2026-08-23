---
title: "Teams & invites"
description: "Create and switch teams, invite members, transfer ownership."
sidebar_order: 3
sidebar_section: "Core Concepts"
---

# Teams & invites

Teams are the workspace unit in Electrik. Billing and many permissions attach to the current team.

## Capabilities

- Create and switch teams
- Team settings and branding / avatar
- Invite members by email (expiry: `ELECTRIK_INVITE_EXPIRES_DAYS`, default 7)
- Accept / deny invitations
- Manage members, leave team, transfer ownership, delete team
- Activity log for team events

## Default roles

Configured in `config/electrik.php`: `owner`, `admin`, `member`. See [Roles & permissions](/docs/core-concepts/roles-permissions).

Teams engine is powered by `electrik/teamwork` (Electrik’s Teamwork fork).
