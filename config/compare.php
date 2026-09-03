<?php

/**
 * Electrik vs alternatives — feature matrix + per-competitor editorial.
 * Cell values: yes | no | partial | n/a
 * Keep honest; products change — pages disclose that.
 */

$features = [
    'distribution' => [
        'label' => 'Distribution model',
        'description' => 'How code lands in your app and how you upgrade it.',
    ],
    'auth' => [
        'label' => 'Authentication',
        'description' => 'Login, register, password reset, verification, sessions.',
    ],
    'teams' => [
        'label' => 'Teams / workspaces',
        'description' => 'Multi-user workspaces with invites and switching.',
    ],
    'roles' => [
        'label' => 'Roles & permissions',
        'description' => 'RBAC beyond a single owner/admin flag.',
    ],
    'billing' => [
        'label' => 'Stripe / Cashier billing',
        'description' => 'Subscriptions, invoices, payment methods.',
    ],
    'billing_tenant' => [
        'label' => 'Billing on the team',
        'description' => 'Subscription owned by workspace, not only the user.',
    ],
    'onboarding' => [
        'label' => 'Onboarding wizard',
        'description' => 'Guided first-run flow after signup.',
    ],
    'ui_kit' => [
        'label' => 'Product UI kit',
        'description' => 'First-class Blade (or equivalent) design system for the app shell.',
    ],
    'stack' => [
        'label' => 'Primary stack',
        'description' => 'Livewire, Inertia, Filament, or mix.',
    ],
    'admin_panel' => [
        'label' => 'Admin / resource panel',
        'description' => 'CRUD admin for operators (not end-user SaaS shell).',
    ],
    'vendor_owned' => [
        'label' => 'Vendor-owned upgrades',
        'description' => 'Composer package you update vs scaffold dumped into App\\.',
    ],
    'free_commercial_lane' => [
        'label' => 'Free commercial lane',
        'description' => 'Ship commercially without paying the kit vendor (grant or MIT).',
    ],
    'price_posture' => [
        'label' => 'Kit pricing posture',
        'description' => 'What you typically pay the kit vendor (not your Stripe plans).',
    ],
];

$electrik = [
    'slug' => 'electrik',
    'name' => 'Electrik',
    'url' => 'https://electrik.dev',
    'summary' => 'Laravel SaaS starter as a Composer package: auth, teams, Stripe on the team, Slate UI.',
    'stack_notes' => 'Laravel 12+, Livewire 4, Tailwind v4, electrik/slate.',
    'pricing_blurb' => 'BSL 1.1 — $0 Additional Use Grant for personal/OSS/pre-revenue indie; Solo $99, Studio $149 (unlimited projects), Agency custom.',
    'cells' => [
        'distribution' => ['value' => 'yes', 'note' => 'composer require electrik/electrik'],
        'auth' => ['value' => 'yes', 'note' => '2FA, sessions, verification'],
        'teams' => ['value' => 'yes', 'note' => 'Teamwork fork + invites'],
        'roles' => ['value' => 'yes', 'note' => 'Spatie, team-scoped'],
        'billing' => ['value' => 'yes', 'note' => 'Cashier + plan sync'],
        'billing_tenant' => ['value' => 'yes', 'note' => 'Cashier customer = Team'],
        'onboarding' => ['value' => 'yes', 'note' => 'Configurable wizard'],
        'ui_kit' => ['value' => 'yes', 'note' => 'Electrik Slate (MIT)'],
        'stack' => ['value' => 'yes', 'note' => 'Livewire 4'],
        'admin_panel' => ['value' => 'no', 'note' => 'Product shell, not Filament admin'],
        'vendor_owned' => ['value' => 'yes', 'note' => 'Code stays under Electrik\\'],
        'free_commercial_lane' => ['value' => 'partial', 'note' => 'Grant for indie/OSS; companies need commercial'],
        'price_posture' => ['value' => 'partial', 'note' => '$0 grant or one-time commercial tiers'],
    ],
];

$competitors = [
    'jetstream' => [
        'name' => 'Laravel Jetstream',
        'url' => 'https://jetstream.laravel.com',
        'summary' => 'Official Laravel application scaffold with auth, optional teams, and profile management — no Stripe billing.',
        'stack_notes' => 'Livewire or Inertia (Vue/React); published into your application.',
        'pricing_blurb' => 'MIT / free. You add Cashier or Spark yourself for billing.',
        'seo_description' => 'Electrik vs Jetstream: Composer package with team-scoped Stripe billing and Slate UI, versus Laravel’s official auth/teams scaffold with no billing. Feature matrix and when to choose each.',
        'verdict' => 'Jetstream is the right default when you want Laravel’s official auth/teams scaffold and are happy owning every file. Electrik wins when you also need team-scoped Stripe billing, an upgradable Composer package, and a dedicated Blade UI kit (Slate) without assembling Spark + a theme yourself.',
        'intro' => 'Jetstream ships the authentication and team patterns many Laravel SaaS apps start from. It is maintained by the Laravel team, well documented, and deliberately incomplete as a billing product — by design you compose Cashier, Spark, or a custom billing layer on top.',
        'sections' => [
            [
                'title' => 'Package vs scaffold',
                'body' => 'Jetstream uses an installer that publishes controllers, views, and actions into your app. That is excellent for total control and for learning Laravel conventions. It also means upgrades are merges: you own the drift. Electrik installs as electrik/electrik — product code stays under the Electrik\\ namespace. You customize via config, env flags, and selective view publishes, then composer update for kit fixes.',
            ],
            [
                'title' => 'Teams without billing',
                'body' => 'Jetstream teams cover membership and basic roles. Electrik teams are the billing tenant: Cashier attaches to the team, plans sync with electrik:stripe:sync, and Spatie permissions are team-scoped. If your product sells seats or workspace plans, that difference is the whole product model — not a weekend plugin.',
            ],
            [
                'title' => 'UI surface',
                'body' => 'Jetstream’s Livewire stack uses Tailwind and published Blade/Vue. Electrik standardizes on Electrik Slate (anonymous Blade components, tokens, dark mode) so the shell matches marketing and docs. Slate is MIT and usable without Electrik; Electrik simply ships on it.',
            ],
            [
                'title' => 'License and money',
                'body' => 'Jetstream is free and MIT — you can ship commercially at $0 to Laravel. Electrik’s source is BSL 1.1: personal, educational, OSS, and pre-revenue indie use are covered by the Additional Use Grant; companies and client work need Solo/Studio/Agency. You are not paying Electrik to unlock billing features — those ship in the package either way.',
            ],
        ],
        'when_electrik' => [
            'You want auth + teams + Stripe on the team in one Composer install',
            'You prefer vendor-owned upgrades over merging published scaffolds',
            'You want Slate Blade UI instead of assembling a theme',
            'You are fine with BSL for commercial company use',
        ],
        'when_them' => [
            'You only need auth/profile/teams and will build billing later (or never)',
            'You want every line of the scaffold in App\\ under your full ownership',
            'You standardize on Inertia + Vue/React instead of Livewire',
            'You need a fully MIT stack with zero BSL considerations',
        ],
        'caveats' => [
            'Jetstream is the longer-running official scaffold; Electrik 5.0.0 is newly stable as a package.',
            'Comparisons reflect publicly documented Jetstream features; stacks evolve.',
            '“Free commercial” for Jetstream means the scaffold license — not that billing is free to build.',
        ],
        'faqs' => [
            [
                'question' => 'Is Electrik a Jetstream replacement?',
                'answer' => 'For many SaaS apps, yes in spirit: auth, teams, and a product shell. Electrik adds team billing and a package distribution model Jetstream does not attempt. If you only need Jetstream’s scope, stay on Jetstream.',
            ],
            [
                'question' => 'Can I use Jetstream and Electrik together?',
                'answer' => 'Not as overlapping scaffolds. Pick one shell. You can still use Electrik Slate as a UI kit in a Jetstream app via electrik/slate without installing Electrik.',
            ],
            [
                'question' => 'Does Jetstream include Stripe billing?',
                'answer' => 'No. Pair Jetstream with Laravel Cashier or Laravel Spark. Electrik ships Cashier-based billing on the team out of the box.',
            ],
        ],
        'cells' => [
            'distribution' => ['value' => 'no', 'note' => 'Installer publishes into App\\'],
            'auth' => ['value' => 'yes', 'note' => 'First-party Laravel'],
            'teams' => ['value' => 'partial', 'note' => 'Optional teams feature'],
            'roles' => ['value' => 'partial', 'note' => 'Basic team roles'],
            'billing' => ['value' => 'no', 'note' => 'Add Cashier/Spark'],
            'billing_tenant' => ['value' => 'no', 'note' => 'Not included'],
            'onboarding' => ['value' => 'no', 'note' => 'DIY'],
            'ui_kit' => ['value' => 'partial', 'note' => 'Published views / Inertia pages'],
            'stack' => ['value' => 'yes', 'note' => 'Livewire or Inertia'],
            'admin_panel' => ['value' => 'no', 'note' => 'Not an admin framework'],
            'vendor_owned' => ['value' => 'no', 'note' => 'You own published files'],
            'free_commercial_lane' => ['value' => 'yes', 'note' => 'MIT'],
            'price_posture' => ['value' => 'yes', 'note' => '$0 for the scaffold'],
        ],
    ],

    'spark' => [
        'name' => 'Laravel Spark',
        'url' => 'https://spark.laravel.com',
        'summary' => 'Official Laravel billing UI and Cashier integration — sold per project, focused on subscriptions rather than a full SaaS kit.',
        'stack_notes' => 'Spark Stripe / Paddle editions; Livewire or Inertia depending on generation.',
        'pricing_blurb' => 'Commercial per-project license (historically hundreds of USD per project). Billing product, not a free grant lane.',
        'seo_description' => 'Electrik vs Laravel Spark: full SaaS kit with auth, teams, and team billing in one Composer package, versus Spark’s per-project billing add-on. Matrix and when to buy which.',
        'verdict' => 'Spark is the right buy when you already have an app shell and need a polished, first-party billing experience. Electrik is the better starting kit when you still need auth, teams, onboarding, and UI — with billing included in the base package under BSL instead of a separate per-project Spark invoice.',
        'intro' => 'Spark productizes subscription management for Laravel: plans, invoices, payment methods, and Cashier wiring with an official UI. It assumes you bring (or already have) the rest of the SaaS: authentication patterns, team tenancy, roles, and product screens.',
        'sections' => [
            [
                'title' => 'Billing product vs SaaS kit',
                'body' => 'Spark solves billing. Electrik solves the shell plus billing: auth, teams, Spatie permissions, onboarding, API tokens, and Slate UI, with Cashier on the team model. If your gap is only “Cashier UI and plan management,” Spark is narrowly better. If your gap is “ship a SaaS,” Electrik covers more surface area in one install.',
            ],
            [
                'title' => 'Per-project cost',
                'body' => 'Spark’s commercial model is typically per project. Electrik commercial tiers (Solo/Studio) are one-time licenses for using the Electrik kit itself; the BSL grant covers many indie cases at $0. Neither license replaces your Stripe fees — both help you bill customers.',
            ],
            [
                'title' => 'Team as customer',
                'body' => 'Electrik treats the team as the Cashier customer so workspace subscriptions match multi-tenant SaaS. Spark can be configured for various billable models; Electrik opinionates team billing so the rest of the kit (invites, roles, plan features) lines up.',
            ],
            [
                'title' => 'UI and ownership',
                'body' => 'Spark ships its billing UI. Electrik billing screens use Slate. Spark stays the Laravel “official” billing brand; Electrik stays vendor-owned as a Composer package for the whole shell.',
            ],
        ],
        'when_electrik' => [
            'You need a full starter (auth/teams/UI) not only billing screens',
            'You want team-scoped subscriptions aligned with invites and roles',
            'You prefer one kit license / grant instead of Spark per project',
            'You are starting greenfield on Livewire + Blade',
        ],
        'when_them' => [
            'You already have Jetstream/Breeze/custom auth and only need billing UI',
            'You want Laravel’s official Spark brand and support channel',
            'Your billable model is user-centric and Spark already fits',
            'You are mid-migration and Spark is already purchased for the project',
        ],
        'caveats' => [
            'Spark editions and pricing change — verify current Spark Stripe terms on spark.laravel.com.',
            'Electrik billing is Cashier-based on the team; Spark remains Laravel’s dedicated billing product UI.',
            'You can use Cashier without Spark; Electrik and Spark are alternative productizations.',
        ],
        'faqs' => [
            [
                'question' => 'Does Electrik replace Spark?',
                'answer' => 'For greenfield SaaS kits, Electrik includes the billing layer Spark specializes in, plus the surrounding shell. If you only need Spark’s billing UI on an existing app, buy Spark.',
            ],
            [
                'question' => 'Can I use Spark with Electrik?',
                'answer' => 'Not as two overlapping billing UIs. Choose one subscription surface. Electrik is built around its own Cashier + team billing pages.',
            ],
            [
                'question' => 'Why does pricing mention Spark?',
                'answer' => 'Because Spark is the common Laravel reference for paid billing kits. Electrik’s pitch is Spark-class billing inside a broader package with a different license posture.',
            ],
        ],
        'cells' => [
            'distribution' => ['value' => 'partial', 'note' => 'Composer package for billing UI'],
            'auth' => ['value' => 'no', 'note' => 'Bring your own'],
            'teams' => ['value' => 'no', 'note' => 'Not a teams kit'],
            'roles' => ['value' => 'no', 'note' => 'Not included'],
            'billing' => ['value' => 'yes', 'note' => 'Core product'],
            'billing_tenant' => ['value' => 'partial', 'note' => 'Configurable billable'],
            'onboarding' => ['value' => 'no', 'note' => 'Not included'],
            'ui_kit' => ['value' => 'partial', 'note' => 'Billing UI only'],
            'stack' => ['value' => 'yes', 'note' => 'Livewire / Inertia editions'],
            'admin_panel' => ['value' => 'no', 'note' => 'Billing, not admin CRUD'],
            'vendor_owned' => ['value' => 'yes', 'note' => 'Package-style billing'],
            'free_commercial_lane' => ['value' => 'no', 'note' => 'Paid per project'],
            'price_posture' => ['value' => 'no', 'note' => 'Commercial Spark license'],
        ],
    ],

    'wave' => [
        'name' => 'Wave',
        'url' => 'https://devdojo.com/wave',
        'summary' => 'Open SaaS starter from DevDojo — auth, blogging/CMS-style features, and SaaS building blocks with a different product philosophy than Electrik.',
        'stack_notes' => 'Laravel-based; historically Livewire-oriented with DevDojo’s Wave ecosystem.',
        'pricing_blurb' => 'Open-source Wave core with DevDojo commercial offerings around themes/pro — verify current license on the Wave site.',
        'seo_description' => 'Electrik vs Wave: Composer SaaS kit with team Stripe billing and Slate UI, versus DevDojo’s Wave starter. Feature matrix and fit guidance.',
        'verdict' => 'Wave fits builders who want a DevDojo-shaped SaaS starter (often with content/blog DNA) and are comfortable in that ecosystem. Electrik fits builders who want a Composer package focused on teams + Stripe billing + Slate Blade UI, with an explicit BSL commercial story.',
        'intro' => 'Wave popularized “SaaS starter” for Laravel indie hackers: authentication, subscriptions ideas, and a community around DevDojo. It is a different product lineage than Electrik’s package-first, team-billed, Slate-skinned kit.',
        'sections' => [
            [
                'title' => 'Product shape',
                'body' => 'Wave often feels like an application template with SaaS and content features. Electrik is deliberately a vendor package: install, configure, keep App\\ for your domain. If you want to fork a full app and own every folder, Wave’s template mindset may feel more natural. If you want upgradable kit code, Electrik’s model matches Slate’s Composer story.',
            ],
            [
                'title' => 'Teams and billing',
                'body' => 'Electrik’s center of gravity is team workspaces with Cashier on the team and Spatie roles. Wave’s strengths and gaps differ by version — treat team-scoped billing and Spatie integration as Electrik opinions, not universal SaaS-starter defaults.',
            ],
            [
                'title' => 'UI',
                'body' => 'Electrik standardizes on Electrik Slate. Wave ships its own UI/theme approach tied to the DevDojo brand. Neither is “better” universally; pick the design system you want to live in.',
            ],
            [
                'title' => 'License',
                'body' => 'Wave’s open core vs paid DevDojo add-ons is a different commercial shape from Electrik’s BSL + Solo/Studio. Read both licenses before you ship a company product.',
            ],
        ],
        'when_electrik' => [
            'You want package-first upgrades and Electrik\\ namespaced product code',
            'Team-scoped Stripe + Spatie permissions are non-negotiable',
            'You want Slate UI shared with slate.electrik.dev',
            'You like an explicit indie grant vs commercial license page',
        ],
        'when_them' => [
            'You prefer the DevDojo / Wave ecosystem and tutorials',
            'You want a more template-like full application to fork',
            'Content/blog-oriented SaaS starters match your product',
            'Your team already ships Wave in production',
        ],
        'caveats' => [
            'Wave’s feature set and licensing have shifted across versions — confirm current docs.',
            'This page compares product posture, not a line-by-line Wave changelog.',
            'Wave has a longer public track record as a starter brand; Electrik 5.0.0 is newly stable.',
        ],
        'faqs' => [
            [
                'question' => 'Is Electrik based on Wave?',
                'answer' => 'No. Electrik is an independent kit built on Electrik Slate, Teamwork (fork), Spatie Permission, and Cashier.',
            ],
            [
                'question' => 'Which is more “open source”?',
                'answer' => 'Wave markets an open SaaS starter; Electrik uses BSL 1.1 with a free Additional Use Grant. MIT UI (Slate) sits beside Electrik. Compare licenses for your use case rather than slogans.',
            ],
            [
                'question' => 'Can I migrate from Wave to Electrik?',
                'answer' => 'There is no automated migrator. Treat it as a new shell: recreate auth/teams/billing on Electrik and move domain models into App\\.',
            ],
        ],
        'cells' => [
            'distribution' => ['value' => 'partial', 'note' => 'Starter app / template oriented'],
            'auth' => ['value' => 'yes', 'note' => 'Included'],
            'teams' => ['value' => 'partial', 'note' => 'Varies by Wave version'],
            'roles' => ['value' => 'partial', 'note' => 'Varies'],
            'billing' => ['value' => 'partial', 'note' => 'SaaS billing patterns; verify edition'],
            'billing_tenant' => ['value' => 'partial', 'note' => 'Not Electrik’s team-Cashier model'],
            'onboarding' => ['value' => 'partial', 'note' => 'Varies'],
            'ui_kit' => ['value' => 'partial', 'note' => 'Wave / DevDojo UI'],
            'stack' => ['value' => 'yes', 'note' => 'Laravel + Livewire heritage'],
            'admin_panel' => ['value' => 'partial', 'note' => 'Not Filament-first'],
            'vendor_owned' => ['value' => 'partial', 'note' => 'Template ownership model'],
            'free_commercial_lane' => ['value' => 'partial', 'note' => 'Open core + paid add-ons possible'],
            'price_posture' => ['value' => 'partial', 'note' => 'Free core / paid ecosystem'],
        ],
    ],

    'saasykit' => [
        'name' => 'SaaSykit',
        'url' => 'https://saasykit.com',
        'summary' => 'Commercial Laravel SaaS starter — all-in-one paid kit competing in the same “buy once, ship SaaS” lane as Electrik’s commercial tiers.',
        'stack_notes' => 'Laravel SaaS boilerplate; check current Livewire/Inertia and admin choices on saasykit.com.',
        'pricing_blurb' => 'Typically one-time commercial purchase in the ~$199–$299 range (verify live pricing) — no Electrik-style free commercial grant.',
        'seo_description' => 'Electrik vs SaaSykit: BSL grant lane plus team Cashier billing and Slate UI, versus a paid all-in-one starter. Side-by-side matrix.',
        'verdict' => 'SaaSykit is a strong peer if you want a paid all-in-one starter and prefer their stack and demo. Electrik differentiates on Composer package ownership, Slate UI, team-as-Cashier-customer, and a $0 BSL grant for qualifying indie/OSS use before you buy Solo/Studio.',
        'intro' => 'SaaSykit sells a complete Laravel SaaS foundation: authentication, billing, and product screens aimed at founders who will pay once for a kit. Electrik plays in that market too — with a different distribution model and license story.',
        'sections' => [
            [
                'title' => 'Same category, different delivery',
                'body' => 'Both aim to save months of SaaS plumbing. SaaSykit is a commercial product with its own demo and roadmap. Electrik ships as electrik/electrik on Packagist, built on MIT Slate, with docs and demo at electrik.dev / demo.electrik.dev. Prefer the kit whose upgrade story and UI you trust.',
            ],
            [
                'title' => 'Money',
                'body' => 'SaaSykit’s list price is a one-time kit purchase for commercial use. Electrik lists Solo $99 / Studio $149 (unlimited projects) for commercial company use, and keeps a free Additional Use Grant for personal, educational, open-source, and pre-revenue indie work. Feature unlock is not paywalled either way on Electrik — license is about permission to use commercially.',
            ],
            [
                'title' => 'Teams and billing',
                'body' => 'Electrik opinionates team workspaces and Stripe on the team with Spatie permissions. SaaSykit includes SaaS billing and multi-user patterns — compare their current docs for tenancy details. Do not assume identical tenant models.',
            ],
            [
                'title' => 'UI',
                'body' => 'Electrik is Slate-first (Blade anonymous components). SaaSykit ships its own UI system and marketing tools (including popular Tailwind utilities). If you already love SaaSykit’s design language, that alone can decide the purchase.',
            ],
        ],
        'when_electrik' => [
            'You want a Packagist package under Electrik\\ with Slate UI',
            'You need the BSL indie grant before buying commercial',
            'Team-scoped Cashier + Spatie is your tenancy model',
            'You care about open Slate / slate-blocks MIT alongside the kit',
        ],
        'when_them' => [
            'SaaSykit’s demo and feature checklist map 1:1 to your product',
            'You prefer their UI, docs, and support channel',
            'You want a straightforward paid boilerplate without BSL nuances',
            'Their stack choices (admin, Inertia, etc.) match your team',
        ],
        'caveats' => [
            'SaaSykit pricing and features change — confirm on saasykit.com before buying either kit.',
            'This is a competitive comparison written by Electrik; read both demos.',
            'Evaluate Electrik 5.0.0 maturity and support against SaaSykit’s release cadence.',
        ],
        'faqs' => [
            [
                'question' => 'Is Electrik cheaper than SaaSykit?',
                'answer' => 'For qualifying indie/OSS use, Electrik’s grant is $0. For company commercial use, compare Solo/Studio to SaaSykit’s current one-time price — they land in a similar band. Feature sets are not identical.',
            ],
            [
                'question' => 'Does Electrik include a Tailwind color generator like SaaSykit?',
                'answer' => 'Electrik’s marketing site ships a free Tailwind color generator at /tools. That is a website tool, not part of the SaaS runtime package.',
            ],
            [
                'question' => 'Can I switch later?',
                'answer' => 'Switching starters mid-product is costly. Prototype on both demos (Electrik: demo.electrik.dev) before committing.',
            ],
        ],
        'cells' => [
            'distribution' => ['value' => 'partial', 'note' => 'Commercial boilerplate product'],
            'auth' => ['value' => 'yes', 'note' => 'Included'],
            'teams' => ['value' => 'yes', 'note' => 'Multi-user SaaS patterns'],
            'roles' => ['value' => 'yes', 'note' => 'RBAC in kit'],
            'billing' => ['value' => 'yes', 'note' => 'Subscriptions included'],
            'billing_tenant' => ['value' => 'partial', 'note' => 'Verify tenancy model in docs'],
            'onboarding' => ['value' => 'partial', 'note' => 'Typical in this category'],
            'ui_kit' => ['value' => 'yes', 'note' => 'SaaSykit UI'],
            'stack' => ['value' => 'yes', 'note' => 'Laravel SaaS stack'],
            'admin_panel' => ['value' => 'partial', 'note' => 'Often includes admin features'],
            'vendor_owned' => ['value' => 'partial', 'note' => 'Boilerplate you own after purchase'],
            'free_commercial_lane' => ['value' => 'no', 'note' => 'Paid kit'],
            'price_posture' => ['value' => 'no', 'note' => '~$199–$299 one-time class'],
        ],
    ],

    'larafast' => [
        'name' => 'Larafast',
        'url' => 'https://larafast.com',
        'summary' => 'Commercial Laravel SaaS starter kit in the same paid all-in-one category as SaaSykit — auth, billing, and shipping speed for founders.',
        'stack_notes' => 'Laravel SaaS boilerplate; confirm Livewire/Inertia and modules on larafast.com.',
        'pricing_blurb' => 'One-time commercial purchase typically in the ~$199–$299 class (verify live pricing). No Electrik-style free company commercial grant.',
        'seo_description' => 'Electrik vs Larafast: package-first Laravel SaaS kit with team billing and Slate, versus another commercial starter. Honest feature matrix.',
        'verdict' => 'Larafast is a peer commercial kit: buy it if their demo, stack, and support win you over. Electrik competes with package-first delivery, Slate UI, team Cashier tenancy, and a documented $0 grant lane for qualifying non-company use.',
        'intro' => 'Larafast markets speed-to-SaaS for Laravel developers willing to pay for a curated starter. Electrik targets the same job-to-be-done with a Composer package model and BSL licensing.',
        'sections' => [
            [
                'title' => 'Category peers',
                'body' => 'Larafast and Electrik both reduce auth/billing boilerplate. Differences show up in tenancy opinions, UI systems, license text, and whether kit code stays upgradable as a package. Run both demos with your actual product checklist.',
            ],
            [
                'title' => 'Pricing posture',
                'body' => 'Larafast sells commercial access up front. Electrik separates feature access from commercial permission: full features in source, grant for indie/OSS/pre-revenue, paid Solo/Studio when a company ships. Pick the ethics and paperwork you prefer — not only the sticker price.',
            ],
            [
                'title' => 'Teams + Stripe',
                'body' => 'Electrik’s documented model is teams as Cashier customers with Spatie team roles. Larafast includes billing and team-like features — read their docs for the exact tenant and seat model before assuming parity.',
            ],
            [
                'title' => 'UI and agents',
                'body' => 'Electrik invests in Slate docs, llms.txt, and install skills so agents generate Blade correctly. Larafast’s DX story is its own — compare docs quality for your workflow (human or agent).',
            ],
        ],
        'when_electrik' => [
            'Composer package + Slate is your preferred architecture',
            'You want a free grant lane before commercial license',
            'Team-scoped billing is a hard requirement',
            'You already use or plan to use electrik/slate',
        ],
        'when_them' => [
            'Larafast’s feature list and demo match your MVP exactly',
            'You want their support/community and release style',
            'You prefer a classic paid boilerplate license',
            'Their admin or module pack covers your roadmap',
        ],
        'caveats' => [
            'Larafast pricing and modules change — verify on larafast.com.',
            'Competitive page written by Electrik; evaluate both products hands-on.',
            'Compare Electrik 5.0.0 maturity and support to Larafast’s release cadence.',
        ],
        'faqs' => [
            [
                'question' => 'Electrik vs Larafast — who wins on price?',
                'answer' => 'Indie grant users: Electrik can be $0. Company commercial: compare Solo/Studio to Larafast’s current one-time price. Total cost includes your time integrating either kit.',
            ],
            [
                'question' => 'Do both include Stripe?',
                'answer' => 'Both category kits include subscription billing. Electrik uses Laravel Cashier with the team as customer; confirm Larafast’s billable model in their docs.',
            ],
            [
                'question' => 'Is Electrik trying to undercut Larafast?',
                'answer' => 'Electrik’s edge is package + Slate + grant clarity, not a race to the lowest kit price. Buy the architecture you will maintain.',
            ],
        ],
        'cells' => [
            'distribution' => ['value' => 'partial', 'note' => 'Commercial boilerplate'],
            'auth' => ['value' => 'yes', 'note' => 'Included'],
            'teams' => ['value' => 'yes', 'note' => 'SaaS multi-user'],
            'roles' => ['value' => 'yes', 'note' => 'RBAC typical'],
            'billing' => ['value' => 'yes', 'note' => 'Subscriptions'],
            'billing_tenant' => ['value' => 'partial', 'note' => 'Verify in Larafast docs'],
            'onboarding' => ['value' => 'partial', 'note' => 'Common in kits'],
            'ui_kit' => ['value' => 'yes', 'note' => 'Larafast UI'],
            'stack' => ['value' => 'yes', 'note' => 'Laravel SaaS'],
            'admin_panel' => ['value' => 'partial', 'note' => 'Often included'],
            'vendor_owned' => ['value' => 'partial', 'note' => 'You own purchased code'],
            'free_commercial_lane' => ['value' => 'no', 'note' => 'Paid kit'],
            'price_posture' => ['value' => 'no', 'note' => '~$199–$299 one-time class'],
        ],
    ],

    'filament' => [
        'name' => 'Filament',
        'url' => 'https://filamentphp.com',
        'summary' => 'The leading Laravel admin panel framework — exceptional for operator CRUD; not the same job as a multi-tenant SaaS product shell with team billing.',
        'stack_notes' => 'Livewire-powered admin panels, forms, tables, and resource UIs. Many “Filament starters” wrap Filament + auth/billing.',
        'pricing_blurb' => 'Filament core is free (TALL stack). Plugins and third-party starters may be paid. Admin framework ≠ Electrik commercial license.',
        'seo_description' => 'Electrik vs Filament: end-user SaaS shell (auth, teams, Stripe, Slate) versus admin/resource panels. Complementary more often than substitutes.',
        'verdict' => 'Use Filament when your product is an admin/back-office or you need resource CRUD fast. Use Electrik when you are shipping an end-user SaaS (auth, teams, Stripe plans, onboarding) with Slate product UI. Many apps need both: Electrik (or custom) for the customer app, Filament for internal ops — they are complementary more often than substitutes.',
        'intro' => 'Filament dominates Laravel admin UX: resources, forms, tables, notifications, and a plugin ecosystem. Comparing it to Electrik only makes sense because many founders search “Laravel SaaS starter” and land on Filament starters. The jobs differ.',
        'sections' => [
            [
                'title' => 'Admin panel vs product shell',
                'body' => 'Filament optimizes for administrators managing database resources. Electrik optimizes for customers registering, joining teams, subscribing, and using a product UI built with Slate. Building customer-facing marketing-quality SaaS screens in Filament is possible but fighting the grain; building an internal CRM in Electrik without Filament is possible but slower than Filament resources.',
            ],
            [
                'title' => 'Filament-based starters',
                'body' => 'Third-party kits bolt auth and Stripe onto Filament. Those can be excellent if your SaaS is admin-shaped. Electrik’s demo and docs assume a Jetstream-like product app with billing on the team — closer to “customer workspace” than “staff panel.”',
            ],
            [
                'title' => 'UI systems',
                'body' => 'Filament has its own design language and Livewire components. Electrik uses Electrik Slate for the app shell. You can install Filament beside Electrik for /admin while keeping Slate for /dashboard — a common split.',
            ],
            [
                'title' => 'Licensing',
                'body' => 'Filament’s open core is free for commercial use. Electrik’s BSL applies to the Electrik package. Using Filament does not replace Electrik’s license if you use Electrik, and vice versa.',
            ],
        ],
        'when_electrik' => [
            'Your users are customers in workspaces, not only staff in an admin',
            'You need team invites, plan limits, and Stripe on the team',
            'You want Slate product UI and onboarding out of the box',
            'You prefer a SaaS kit package over assembling Filament + Cashier + auth',
        ],
        'when_them' => [
            'The product is primarily an admin/back-office',
            'You need Filament resources, tables, and plugins yesterday',
            'A Filament starter already matches your CRUD-heavy SaaS',
            'You will build customer UI separately (or not at all)',
        ],
        'caveats' => [
            '“Filament starter kits” vary wildly — this page compares Filament’s role, not every paid starter.',
            'Electrik does not replace Filament admin CRUD.',
            'You can use both in one Laravel app with clear route prefixes.',
        ],
        'faqs' => [
            [
                'question' => 'Should I pick Filament or Electrik?',
                'answer' => 'Pick based on the primary UI: staff admin → Filament; customer SaaS shell → Electrik. Many products eventually need both.',
            ],
            [
                'question' => 'Does Electrik include Filament?',
                'answer' => 'No. Electrik’s UI is Electrik Slate. Add Filament yourself for operational admin if needed.',
            ],
            [
                'question' => 'Are Filament starters competitors?',
                'answer' => 'Yes in the “Laravel SaaS boilerplate” search market. Architecturally they often center the admin panel; Electrik centers the customer workspace.',
            ],
        ],
        'cells' => [
            'distribution' => ['value' => 'yes', 'note' => 'Composer packages'],
            'auth' => ['value' => 'partial', 'note' => 'Panel auth; not full SaaS kit'],
            'teams' => ['value' => 'no', 'note' => 'Not core Filament'],
            'roles' => ['value' => 'partial', 'note' => 'Policies / plugins'],
            'billing' => ['value' => 'no', 'note' => 'Add Cashier or a starter'],
            'billing_tenant' => ['value' => 'no', 'note' => 'Not core'],
            'onboarding' => ['value' => 'no', 'note' => 'Not core'],
            'ui_kit' => ['value' => 'yes', 'note' => 'Filament admin UI'],
            'stack' => ['value' => 'yes', 'note' => 'Livewire'],
            'admin_panel' => ['value' => 'yes', 'note' => 'Primary strength'],
            'vendor_owned' => ['value' => 'yes', 'note' => 'Package ecosystem'],
            'free_commercial_lane' => ['value' => 'yes', 'note' => 'Filament core free'],
            'price_posture' => ['value' => 'yes', 'note' => 'Core $0; plugins vary'],
        ],
    ],
];

return [
    'disclaimer' => 'Comparisons are based on publicly documented product positioning and may lag vendor changes. Always verify on the competitor’s site and run both demos before you buy or commit.',

    'features' => $features,

    'electrik' => $electrik,

    'competitors' => $competitors,
];
