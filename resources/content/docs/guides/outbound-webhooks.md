---
title: "Outbound webhooks"
description: "Team HTTPS endpoints Electrik calls on workspace events."
sidebar_order: 9
sidebar_section: "Guides"
---

# Outbound webhooks

Teams can register HTTPS endpoints under **Teams → Webhooks**. When events fire, Electrik queues a signed POST.

## Payload

```json
{
  "event": "team.archived",
  "team_id": 1,
  "payload": { "team_id": 1, "name": "Demo Team" },
  "sent_at": "2026-08-29T09:30:00+00:00"
}
```

Headers:

- `Content-Type: application/json`
- `X-Electrik-Event: team.archived`
- `X-Electrik-Signature: <hmac-sha256 of body using endpoint secret>`

Verify with HMAC-SHA256 of the raw body using the secret shown once at create time.

## Events

Use `*` (default) or a comma-separated list. Built-in dispatches include:

- `team.archived`
- `team.restored`
- `team.deleted`

Extend by calling `Electrik\Support\TeamWebhookDispatcher::dispatch($team, $event, $payload)`.

## Deliveries

Each attempt stores status code / success flag on `team_webhook_deliveries`. Failure count increments on the endpoint; successful delivery resets it.

## Inbound Stripe webhooks

Separate from team outbound webhooks. Stripe → Cashier events are logged for ops at `/ops/webhooks` (`stripe_webhook_events`).
