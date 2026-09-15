# Money path — Electrik Launch + vertical shortlist

**Owner:** agent (boss)  
**Locked:** 2026-09-14  
**Premise:** Generic kit licenses are a weak primary business. Electrik is the factory. Cash = productized launches now; MRR = one vertical SaaS next.

Related: research canvas `relay-market-research.canvas.tsx` · `path-to-2k.md` (licenses stay as side door)

---

## 1. Electrik Launch (productized build)

### Offer name

**Electrik Launch** — “Live multi-tenant Laravel SaaS in 14 days.”

Sold by **Quick Brown Fox** (studio behind Electrik). Electrik Studio license included.

### Who buys

- Founder with a clear SaaS idea who wants shipping, not a kit
- Agency that needs a client MVP without rebuilding auth/teams/billing
- Soft inbound from electrik.dev/contact

**Not:** “teach me Laravel,” greenfield React, or endless custom consulting.

### Price (frozen 90 days)

| Package | Price | Days | Notes |
| --- | --- | --- | --- |
| **Launch** | **$6,900** | 14 calendar days | Default SKU |
| **Launch+** | **$9,900** | 21 days | +1 extra domain model + basic admin ops polish |
| **Retain (optional)** | **$1,500/mo** | monthly | Bugfix + small changes (cap 8h) after handoff |

50% deposit to start · 50% on handoff. Stripe/Dodo invoice via QBF.

### What is included (Launch $6,900)

1. Fresh Laravel 12/13 + Electrik 5.4 + Slate 3 on your hosting (or Fly/Forge we set up)
2. Auth, teams, invites, roles, Stripe Cashier on the **team** (test mode wired; you add live keys)
3. Brand: logo, primary color, app name
4. **One** core product resource (CRUD + team scope) — e.g. Clients, Projects, or your named entity
5. Dashboard shell + onboarding pass
6. Deploy to staging + production checklist
7. 60-minute handoff call + short Loom
8. Electrik **Studio** commercial license for that product

### Explicitly out of scope

- Mobile apps, React/Inertia rewrite
- Custom design system (Slate only)
- Migrations from legacy apps
- WhatsApp / omnichannel / heavy AI agents
- Content writing, SEO campaigns, paid ads
- More than one core resource (use Launch+)
- Live Stripe go-live if keys/legal not ready (we leave test mode + docs)

### Done when

Buyer can: register → create team → invite member → see branded shell → use the one CRUD → open billing page in Stripe test.

### Sales one-liner

> Electrik Launch: we ship your multi-tenant Laravel SaaS shell (auth, teams, Stripe, UI) plus one core feature in 14 days for $6,900. You own the code. We use Electrik so we don’t rebuild plumbing.

### Email / Contact subject lines

- `Electrik Launch — live SaaS in 14 days`
- `Fixed-price Laravel SaaS launch ($6,900)`

### Paste-ready reply (inbound)

```
Thanks for reaching out.

We offer Electrik Launch: a fixed $6,900 / 14-day package that ships a multi-tenant Laravel SaaS with auth, teams, Stripe billing, Slate UI, and one core product feature — on Electrik so we don’t rebuild plumbing. Studio license included. You own the code.

Out of scope: mobile, custom design systems, big migrations, open-ended consulting.

If that fits, reply with:
1) what the product does in one sentence
2) the one main “thing” users manage (e.g. projects, clients, bookings)
3) ideal go-live window

— Quick Brown Fox / Electrik
```

### Outreach angle (agencies — different from license pitch)

Past outreach sold Studio/Agency **licenses**. New angle for warm follow-ups / new shops:

```
Subject: Fixed-price Laravel SaaS launch for your clients

Hi {name} —

We built Electrik (Laravel SaaS shell: teams + Stripe + Slate). Beside licenses, we now sell Electrik Launch: $6,900 / 14 days — auth, teams, billing, branding, one core CRUD, deploy, handoff. Useful when a client needs an MVP and you don’t want to rebuild Jetstream/Cashier again.

Happy to white-label delivery under your studio if preferred.

Demo: https://demo.electrik.dev
Offer notes: happy to send the one-pager.

— Neeraj / Quick Brown Fox
```

**Cadence:** keep 10–20/week, but **half** can be Launch-shaped (client MVP help), half license. Do not re-blast shops already emailed for licenses in the last 14 days — wait or soft follow-up only.

### Site / ops next (when we ship pages)

- [x] `/launch` one-pager on electrik.dev (or QBF) with price + scope + CTA mailto — **2026-09-14**
- [x] Contact page: add “Electrik Launch $6,900 / 14 days” bullet
- [x] Homepage studio strip: mention Launch once (not a fourth product card) — price lane

---

## 2. Vertical SaaS shortlist

**Rule:** sell a finished job at $39–$99/mo. Electrik stays inside. Buyers never need to know “starter kit.”

### Scoring (1–5)

Fit = uses teams + billing + Blade/Livewire we already have.  
Reach = we can find buyers without a huge audience.  
Speed = MVP in ≤4 weeks on Electrik.  
Avoid = crowded Chatbase-like or needs deep domain we don’t have.

| # | Niche | Price aim | Fit | Reach | Speed | Verdict |
| --- | --- | --- | --- | --- | --- | --- |
| **1** | **Client portal for agencies / freelancers** (files, status, messages, invoices later) | $49–$79/mo | 5 | 4 | 5 | **PICK** |
| 2 | Document chase for bookkeepers / accountants | $69–$99/mo | 4 | 3 | 4 | Strong #2 |
| 3 | Proposal + client onboarding for consultants | $39–$69/mo | 4 | 3 | 4 | Later |
| 4 | Internal “Studio” ops for productized agencies | $79/mo | 5 | 2 | 4 | Too meta |
| 5 | AI support desk (hosted Relay) | $49/mo | 3 | 4 | 2 | Defer — Chatbase war |
| 6 | Generic project management | $29/mo | 5 | 1 | 5 | Kill — Basecamp/Asana |

### Locked pick: **Portal** (working name)

**One sentence:** Branded client portal for freelancers and small agencies — clients log in, see project status, files, and messages; you bill seats/clients on Stripe.

**Why #1**

- Electrik demo already has Clients → Projects → Tasks (Studio sample)
- Teams + Stripe on team = natural seat/client limits
- Slate = “looks professional” without a design detour
- Clear buyer: freelancers/agencies tired of Google Drive + email
- Not competing with Chatbase; competing with messy Drive folders

**MVP (4 weeks max)**

1. Agency team signs up (Electrik)
2. Create clients → invite client users (read-limited role)
3. Projects with status + file uploads + simple message thread
4. Plans: Solo $49 (10 clients) · Studio $79 (40 clients)
5. Marketing site + Stripe live checkout

**Not in MVP:** contracts/e-sign, Xero, AI, white-label domains (add after 10 paying).

**Kill criteria (day 45 after soft launch)**

- < 5 paying OR < 20 serious waitlist emails → pivot to niche #2 (document chase) using same shell

### Niche #2 backup: Document chase (bookkeepers)

Request list → client uploads → reminders. Same Electrik shell; different primary object (`DocumentRequest`). Only start if Portal misses kill criteria.

---

## 3. How the pieces fit

```
License $99/$149     → side door + Packagist trust
Electrik Launch $6.9k → near-term cash (QBF)
Portal $49–$79/mo     → compounding MRR (new product brand)
```

Do **not** rename Electrik into Portal. Portal gets its own small brand later (TBD). Electrik stays the kit + Launch engine.

---

## 4. This week execution

1. Use Launch paste-ready reply on any Contact / hello@ project inbound  
2. Soft follow-up only to agencies that asked about delivery (not cold re-pitch all of outreach.csv)  
3. Portal MVP spike plan (models + roles) — next coding session when Launch page or first deposit lands  
4. Licenses: keep path-to-2k rhythm, demote expectation

---

## 5. Open naming (not blocking)

- Launch offer name: **Electrik Launch** (locked)
- Vertical product name: TBD (candidates: Portal, Clientbay, Studiogate — decide at MVP start)
