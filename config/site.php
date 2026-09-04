<?php

return [

    'name' => env('SITE_NAME', 'Electrik'),

    'tagline' => env('SITE_TAGLINE', 'Laravel SaaS starter kit'),

    'version' => env('ELECTRIK_VERSION', '5.2.0'),

    'demo_url' => env('ELECTRIK_DEMO_URL', 'https://demo.electrik.dev'),

    'github_url' => 'https://github.com/electrikhq/electrik',

    'slate_url' => 'https://slate.electrik.dev',

    'packagist_url' => 'https://packagist.org/packages/electrik/electrik',

    'commercial_email' => env('ELECTRIK_COMMERCIAL_EMAIL', 'hello@electrik.dev'),

    'twitter_handle' => '@electrikhq',

    /*
    |--------------------------------------------------------------------------
    | Studio / client work (Quick Brown Fox)
    |--------------------------------------------------------------------------
    */

    'studio' => [
        'name' => env('STUDIO_NAME', 'Quick Brown Fox'),
        'url' => env('STUDIO_URL', 'https://quickbrownfox.io'),
        'email' => env('STUDIO_EMAIL', 'hello@electrik.dev'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Commercial license tiers (BSL commercial lane)
    |--------------------------------------------------------------------------
    */

    'commercial_tiers' => [
        [
            'id' => 'solo',
            'name' => 'Solo',
            'price' => '$99',
            'period' => 'one-time',
            'summary' => 'One developer shipping one commercial product.',
            'features' => [
                'Commercial use for a single product',
                'Covers current major (5.x) + minors/patches',
                'Full source, all features included',
                'Email support during onboarding',
            ],
            // Dodo (preferred) or legacy Stripe Payment Link. Empty = mailto fallback.
            // Static site: URLs are baked at export — never put DODO_PAYMENTS_API_KEY in Pages.
            'checkout_url' => env('DODO_CHECKOUT_SOLO') ?: env('STRIPE_CHECKOUT_SOLO'),
        ],
        [
            'id' => 'studio',
            'name' => 'Studio',
            'price' => '$149',
            'period' => 'one-time',
            'summary' => 'Unlimited projects for your studio or small team.',
            'features' => [
                'Unlimited commercial projects',
                'Covers current major (5.x) + minors/patches',
                'Priority support channel',
                'License certificate for clients',
            ],
            'highlight' => true,
            'checkout_url' => env('DODO_CHECKOUT_STUDIO') ?: env('STRIPE_CHECKOUT_STUDIO'),
        ],
        [
            'id' => 'agency',
            'name' => 'Agency',
            'price' => 'Custom',
            'period' => null,
            'summary' => 'Agencies standardizing on Electrik for client delivery.',
            'features' => [
                'Organization-wide commercial rights',
                'Major-line scope negotiated per deal',
                'White-label branding (name, logo, primary color, powered-by)',
                'Volume pricing available',
            ],
            'checkout_url' => null,
        ],
    ],

    'features' => [
        'Email auth, verification, password reset, and profile',
        'Teams: create, switch, invite, and roles',
        'Stripe: team billing, plans, webhooks, customer portal',
        'Onboarding wizard',
        'Slate 3 UI kit (forms, shell, dark mode)',
        'Notifications and activity log',
        'Two-factor authentication',
        'Install stays in vendor — update via Composer',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ecosystem (marketing strip — Electrik stays the hero)
    |--------------------------------------------------------------------------
    */

    'ecosystem' => [
        [
            'name' => 'Electrik',
            'role' => 'SaaS starter kit',
            'summary' => 'Auth, teams, Stripe billing, and onboarding as a Composer package. The product you install to ship.',
            'href' => '/install',
            'cta' => 'Install guide',
            'external' => false,
            'primary' => true,
        ],
        [
            'name' => 'Slate',
            'role' => 'UI kit for Laravel Blade',
            'summary' => 'The design system Electrik is built on. Components, tokens, blocks, and themes you can reuse outside the kit.',
            'href' => 'https://slate.electrik.dev',
            'cta' => 'Slate docs',
            'external' => true,
            'primary' => false,
        ],
        [
            'name' => 'Demo',
            'role' => 'Live proof',
            'summary' => 'A running Electrik app so you can click through teams, billing, and the Slate shell before you commit.',
            'href' => 'https://demo.electrik.dev',
            'cta' => 'Open demo',
            'external' => true,
            'primary' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Ecosystem under-links (not cards — keep homepage to three products)
    |--------------------------------------------------------------------------
    */

    'ecosystem_links' => [
        [
            'label' => 'Docs',
            'href' => '/docs',
            'external' => false,
        ],
        [
            'label' => 'License',
            'href' => '/license',
            'external' => false,
        ],
        [
            'label' => 'GitHub',
            'href' => 'https://github.com/electrikhq/electrik',
            'external' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Newsletter (Listmonk + SES — electrik.dev identity)
    |--------------------------------------------------------------------------
    */

    'newsletter' => [
        'enabled' => env('LISTMONK_NEWSLETTER_ENABLED', env('KIT_NEWSLETTER_ENABLED', true)),
        'provider' => 'listmonk',
        'list_id' => env('LISTMONK_LIST_ID'),
        // Live: Alpine form → Cloudflare Pages Function /newsletter/subscribe → Listmonk.
        // Kit kept in .env only as legacy; do not enable for new signups.
    ],

];
