---
title: "Permissions catalog"
description: "Default permission keys shipped in config/electrik.php."
sidebar_order: 3
sidebar_section: "Reference"
---

# Permissions catalog

Defaults from `config/electrik.php`:

| Key | Display name | Category |
|---|---|---|
| `teams.view` | View teams | Teams |
| `teams.manage` | Manage team settings | Teams |
| `teams.invite` | Invite members | Teams |
| `teams.members` | Manage members | Teams |
| `billing.view` | View billing | Billing |
| `billing.manage` | Manage billing | Billing |
| `access.roles` | Manage roles | Access |
| `users.impersonate` | Impersonate members | Access |

### Role map

- `owner` → `*`
- `admin` → all catalog keys above (including `users.impersonate`)
- `member` → `teams.view`, `billing.view`

Extend the catalog in config, then run `electrik:permissions:sync`.
