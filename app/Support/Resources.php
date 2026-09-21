<?php

namespace App\Support;

class Resources
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            self::laravelSaasStarterKit(),
            self::saasBoilerplate(),
            self::buildLaravelSaas(),
        ];
    }

    /**
     * @return list<string>
     */
    public static function slugs(): array
    {
        return array_map(fn (array $page) => $page['slug'], self::all());
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(string $slug): ?array
    {
        foreach (self::all() as $page) {
            if ($page['slug'] === $slug) {
                return $page;
            }
        }

        return null;
    }

    public static function urlFor(string $slug): string
    {
        return siteCanonicalUrl('/resources/'.$slug);
    }

    /**
     * @return array<string, mixed>
     */
    protected static function laravelSaasStarterKit(): array
    {
        return [
            'slug' => 'laravel-saas-starter-kit',
            'nav_title' => 'Laravel SaaS starter kit',
            'title' => 'Laravel SaaS starter kit — Composer package, not a scaffold dump',
            'description' => 'What a Laravel SaaS starter kit should include in 2026: auth, teams, Stripe on the team, permissions, and UI — and why Electrik ships as a Composer package instead of copying files into app/.',
            'keywords' => [
                'laravel saas starter kit',
                'laravel saas kit',
                'laravel saas starter',
                'laravel saas boilerplate',
                'laravel saas',
                'electrik',
            ],
            'eyebrow' => 'Resource',
            'lede' => 'If you searched for a Laravel SaaS starter kit, you usually want auth, teams, billing, and a UI shell without spending months gluing Jetstream, Cashier, and a theme together. Electrik is that shell — as a Composer package.',
            'sections' => [
                [
                    'heading' => 'What “Laravel SaaS starter kit” usually means',
                    'body' => [
                        'Builders mean a prewired path to a multi-user product: login and registration, team or workspace model, roles, Stripe subscriptions, invoices, and a dashboard shell. Some kits also ship admin panels, blogs, or Filament resources.',
                        'The fork in the road is delivery. Most kits dump code into your app/ folder (Jetstream-style scaffolds or zip boilerplates). You own every merge forever. Electrik keeps auth, teams, and billing under the Electrik\\ namespace and you extend via config, App\\, and published views when needed.',
                    ],
                ],
                [
                    'heading' => 'What Electrik includes',
                    'bullets' => [
                        'Auth — sessions, verification, password reset, 2FA, passkeys, magic link, Socialite',
                        'Teams — create/switch, invites, Spatie permissions, activity, branding, archive',
                        'Billing — Laravel Cashier on the team, plans, add-ons, metered usage, tax IDs, webhooks',
                        'Shell — Studio dashboard, onboarding, profile, API tokens, notifications, /ops console',
                        'UI — Electrik Slate 3 anonymous Blade components and tokens',
                    ],
                ],
                [
                    'heading' => 'Package vs scaffold (why it matters for agents and upgrades)',
                    'body' => [
                        'Scaffold dumps feel fast on day one. On day ninety, Composer updates and AI-assisted edits fight over the same auth files you now “own.”',
                        'A package-first kit keeps the product shell updatable on a major line (Electrik 5.x today). Cursor or Claude Code should write product features in App\\ after reading electrik.dev/llms.txt — not reinvent Jetstream inside vendor-ish copies.',
                    ],
                ],
                [
                    'heading' => 'Pricing and license (honest)',
                    'body' => [
                        'Electrik 5.5+ is MIT — personal or commercial use without a kit license. Prefer composer require electrik/electrik:^5.5. Older tags may still be BSL.',
                        'Paid path is Electrik Launch (fixed-price delivery), not Solo/Studio kit licenses (retired).',
                    ],
                ],
                [
                    'heading' => 'When Electrik is the wrong starter',
                    'bullets' => [
                        'You only need a Filament admin CMS — use Filament, not a SaaS product shell',
                        'You want a Next.js / React kit — different stack; see ShipFast-class tools',
                        'You need multi-database tenancy or custom domains as day-one features — not Electrik’s current scope',
                        'You want a prompt-to-app builder (Lovable/Bolt) — not a Composer package',
                    ],
                ],
            ],
            'related' => [
                ['label' => 'SaaS boilerplate vs Composer package', 'slug' => 'saas-boilerplate'],
                ['label' => 'How to build a Laravel SaaS', 'slug' => 'build-laravel-saas'],
                ['label' => 'Electrik vs Jetstream', 'href' => '/compare/electrik-vs-jetstream'],
            ],
            'faqs' => [
                [
                    'question' => 'Is Electrik a free Laravel SaaS starter kit?',
                    'answer' => 'Yes. Electrik 5.5+ is MIT open source. Prefer ^5.5. Paid option is Electrik Launch delivery if you want us to ship the shell.',
                ],
                [
                    'question' => 'Does Electrik replace Jetstream?',
                    'answer' => 'For many SaaS apps, yes as the auth/teams/billing shell — but the model differs: Jetstream scaffolds into your app; Electrik stays a package. See the Jetstream compare page.',
                ],
                [
                    'question' => 'What Laravel versions does Electrik support?',
                    'answer' => 'Electrik 5.x targets Laravel 12/13 with Livewire 4 and Slate 3. Check Packagist for the current constraint.',
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected static function saasBoilerplate(): array
    {
        return [
            'slug' => 'saas-boilerplate',
            'nav_title' => 'SaaS boilerplate',
            'title' => 'SaaS boilerplate in 2026 — zip dump vs Composer package',
            'description' => 'SaaS boilerplate search usually means auth + billing + teams in a starter. Compare zip/scaffold boilerplates to a Composer-package approach with Electrik on Laravel.',
            'keywords' => [
                'saas boilerplate',
                'saas starter kit',
                'laravel saas boilerplate',
                'saas template',
                'composer saas starter',
            ],
            'eyebrow' => 'Resource',
            'lede' => '“SaaS boilerplate” is one of the highest-volume kit searches. Most results are Next.js zip starters or Laravel scaffolds. Electrik answers the same job on Laravel — without treating your app as a disposable fork of someone else’s auth.',
            'sections' => [
                [
                    'heading' => 'What buyers mean by SaaS boilerplate',
                    'body' => [
                        'A reusable starting point for a subscription product: accounts, workspaces or teams, Stripe (or similar), roles, emails, and a dashboard. Marketing sites call the same thing starter kit, template, or boilerplate interchangeably.',
                        'Volume is real (thousands of monthly searches for “saas boilerplate”), but intent splits: indie Next.js launches, agency client builds, and Laravel teams who already standardized on PHP.',
                    ],
                ],
                [
                    'heading' => 'Three delivery models',
                    'bullets' => [
                        'Zip / git template — copy the repo; you own every file and every upgrade conflict',
                        'Official scaffold (Jetstream/Breeze) — Laravel-native dump into app/; great DX, no opinionated SaaS billing shell',
                        'Composer package (Electrik) — require and install; shell stays vendor-owned on a major line; you build product in App\\',
                    ],
                ],
                [
                    'heading' => 'How Electrik fits the boilerplate job',
                    'body' => [
                        'Electrik is a Laravel SaaS starter kit shaped like a package: teams + Stripe Cashier on the team + Spatie permissions + Slate UI. You run composer require and php artisan electrik:install.',
                        'If your team is on React/Next, a Laravel package is the wrong boilerplate. If your team ships Laravel client SaaS or an in-house product, package-first avoids the “Jetstream + Spark + theme” glue tax.',
                    ],
                ],
                [
                    'heading' => 'Boilerplate checklist (use on any kit)',
                    'bullets' => [
                        'Who is the Stripe customer — user or team/workspace?',
                        'Can you upgrade the kit without merging auth by hand?',
                        'Is the license clear (MIT 5.5+ vs older BSL tags)?',
                        'Is the UI a real system (tokens/components) or one-off markup?',
                        'Will coding agents extend App\\ safely, or edit dumped scaffold forever?',
                    ],
                ],
            ],
            'related' => [
                ['label' => 'Laravel SaaS starter kit', 'slug' => 'laravel-saas-starter-kit'],
                ['label' => 'How to build a Laravel SaaS', 'slug' => 'build-laravel-saas'],
                ['label' => 'Compare kits', 'href' => '/compare'],
            ],
            'faqs' => [
                [
                    'question' => 'Is Electrik a SaaS boilerplate?',
                    'answer' => 'Yes in job-to-be-done terms (auth, teams, billing, shell). It is distributed as a Composer package rather than a zip boilerplate.',
                ],
                [
                    'question' => 'Why not just use a free Next.js SaaS boilerplate?',
                    'answer' => 'If your stack is Laravel, switching to Next for a boilerplate creates long-term staffing and hosting choices. Pick the kit that matches the language you will maintain.',
                ],
                [
                    'question' => 'Does Electrik include multi-tenant databases?',
                    'answer' => 'No. Electrik uses team workspaces as the tenant model in a single database by default. Multi-database tenancy is out of scope for the current line.',
                ],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected static function buildLaravelSaas(): array
    {
        return [
            'slug' => 'build-laravel-saas',
            'nav_title' => 'Build a Laravel SaaS',
            'title' => 'How to build a Laravel SaaS in 2026 (package-first path)',
            'description' => 'A practical path to build a Laravel SaaS: choose package vs scaffold, wire teams and Stripe, ship UI with Slate, and avoid merge hell. Electrik as the Composer shell.',
            'keywords' => [
                'build laravel saas',
                'how to build a saas laravel',
                'build a saas',
                'laravel saas tutorial',
                'laravel teams stripe',
            ],
            'eyebrow' => 'Resource',
            'lede' => 'Building a SaaS on Laravel is still a strong default for product and agency teams. The costly part is not “can Laravel do it?” — it is how you assemble auth, teams, and billing before your actual product exists.',
            'sections' => [
                [
                    'heading' => 'Step 1 — Decide scaffold vs package',
                    'body' => [
                        'Scaffold (Breeze/Jetstream): fastest empty app, you own the files. Package (Electrik): SaaS shell stays updatable; you write product code in App\\.',
                        'If you expect years of product work and AI-assisted coding, prefer a clear boundary between shell and product. That is Electrik’s reason to exist.',
                    ],
                ],
                [
                    'heading' => 'Step 2 — Install the shell',
                    'body' => [
                        'Create a Laravel app, require electrik/electrik, run php artisan electrik:install, configure Stripe test keys, and open the demo personas. Full walkthrough: electrik.dev/install and the Clipy install video linked from that page.',
                    ],
                    'bullets' => [
                        'composer require electrik/electrik',
                        'php artisan electrik:install',
                        'Sync Stripe plans / webhooks for billing',
                        'Point agents at https://electrik.dev/llms.txt before generating features',
                    ],
                ],
                [
                    'heading' => 'Step 3 — Model your product on teams',
                    'body' => [
                        'Electrik treats the team as the workspace and the Cashier billable. Put customer data and feature gates in team context. Use plan features / seats when pricing depends on membership or metered usage.',
                    ],
                ],
                [
                    'heading' => 'Step 4 — UI with Slate, product in App\\',
                    'body' => [
                        'Use Electrik Slate components for app chrome. Add domain Livewire components and models under App\\. Avoid forking Electrik views unless you must — publish narrowly.',
                    ],
                ],
                [
                    'heading' => 'Step 5 — License before you sell',
                    'body' => [
                        'Electrik 5.5+ is MIT — ship commercially without a kit license. Prefer ^5.5. Paid path if you want delivery: Electrik Launch. Read /license and /pricing.',
                    ],
                ],
            ],
            'related' => [
                ['label' => 'Laravel SaaS starter kit', 'slug' => 'laravel-saas-starter-kit'],
                ['label' => 'SaaS boilerplate guide', 'slug' => 'saas-boilerplate'],
                ['label' => 'Install Electrik', 'href' => '/install'],
            ],
            'faqs' => [
                [
                    'question' => 'How long does it take to build a Laravel SaaS with Electrik?',
                    'answer' => 'A working auth/teams/billing shell can be up the same day. Your product timeline still depends on domain features — Electrik removes the shell glue, not the product work.',
                ],
                [
                    'question' => 'Do I need Spark or Cashier separately?',
                    'answer' => 'Electrik uses Laravel Cashier on the team. You do not need Spark for the default Electrik billing path.',
                ],
                [
                    'question' => 'Can I use Electrik for client projects?',
                    'answer' => 'Yes. Electrik 5.5+ is MIT — client and commercial products are fine without a kit license. Prefer ^5.5. Or book Electrik Launch if you want us to ship the shell.',
                ],
            ],
        ];
    }
}
