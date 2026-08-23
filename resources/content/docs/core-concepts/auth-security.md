---
title: "Auth & security"
description: "Login, registration, verification, 2FA, and sessions."
sidebar_order: 2
sidebar_section: "Core Concepts"
---

# Auth & security

## Flows

- Login / logout
- Registration (toggle with `ELECTRIK_REGISTRATION`)
- Email verification (`ELECTRIK_EMAIL_VERIFICATION`)
- Forgot / reset password
- Remember me

## Two-factor authentication

Account security settings include TOTP-based 2FA. Users enable, confirm, and manage recovery from settings.

## Sessions

Users can review and revoke other sessions from account security UI.

## API tokens

Sanctum personal access tokens are managed from settings for API access.

## Post-login destination

`ELECTRIK_HOME` (default `/dashboard`) controls where authenticated users land after login (subject to onboarding / subscription gates).
