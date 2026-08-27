<?php

return [

    'name' => env('SITE_NAME', 'Electrik'),

    'tagline' => env('SITE_TAGLINE', 'Laravel SaaS starter kit'),

    'version' => env('ELECTRIK_VERSION', '5.0.0'),

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
            'price' => '$249',
            'period' => 'one-time',
            'summary' => 'One developer shipping one commercial product.',
            'features' => [
                'Commercial use for a single product',
                'Full source, all features included',
                'Email support during onboarding',
            ],
            // Stripe Payment Link (Dashboard → Payment links). Empty = mailto fallback.
            'checkout_url' => env('STRIPE_CHECKOUT_SOLO'),
        ],
        [
            'id' => 'studio',
            'name' => 'Studio',
            'price' => '$599',
            'period' => 'one-time',
            'summary' => 'Small teams and agencies with multiple client or internal products.',
            'features' => [
                'Unlimited projects for your studio',
                'Priority support channel',
                'License certificate for clients',
            ],
            'highlight' => true,
            'checkout_url' => env('STRIPE_CHECKOUT_STUDIO'),
        ],
        [
            'id' => 'agency',
            'name' => 'Agency',
            'price' => 'Custom',
            'period' => null,
            'summary' => 'Agencies standardizing on Electrik for client delivery.',
            'features' => [
                'Organization-wide commercial rights',
                'White-label friendly app shell',
                'Volume pricing available',
            ],
            'checkout_url' => null,
        ],
    ],

    'features' => [
        'Auth, email verification, password reset, remember me',
        'Teams with invites, roles, and Spatie permissions',
        'Stripe billing on the team (Cashier)',
        'Onboarding wizard, notifications, activity log',
        'Two-factor auth, API tokens, profile photos',
        'Slate 3 UI: vendor package, no copy-on-install',
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
    | Newsletter (Kit — form id is public-ish; API key stays server-side)
    |--------------------------------------------------------------------------
    */

    'newsletter' => [
        'enabled' => env('KIT_NEWSLETTER_ENABLED', true),
        'provider' => 'kit',
        'form_id' => env('KIT_FORM_ID'),
        'form_uid' => env('KIT_FORM_UID'),
        // Live: Alpine form → Cloudflare Pages Function /newsletter/subscribe → Kit API.
        // Kit's public embed JS URL currently 404s for this form; do not rely on embed.
    ],

];
