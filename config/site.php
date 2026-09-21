<?php

return [

    'name' => env('SITE_NAME', 'Electrik'),

    'tagline' => env('SITE_TAGLINE', 'Laravel SaaS starter kit'),

    'version' => env('ELECTRIK_VERSION', '5.5.0'),

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
    | Legacy commercial tiers (retired 2026-09-21 — Electrik is MIT)
    | Kept empty so old templates that loop the key do not explode.
    | Pricing page is MIT + Launch; do not re-enable Solo/Studio Buy.
    |--------------------------------------------------------------------------
    */

    'commercial_tiers' => [],

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
