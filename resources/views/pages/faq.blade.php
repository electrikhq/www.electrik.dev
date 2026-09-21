@extends('layouts.www')

@php
    $faqs = [
        [
            'section' => 'Product',
            'items' => [
                [
                    'question' => 'What is Electrik?',
                    'answer' => 'Electrik is a Laravel SaaS starter kit distributed as a Composer package. It includes authentication, team workspaces, role-based permissions, Stripe billing on teams, onboarding, and a Slate 3 UI.',
                ],
                [
                    'question' => 'How is Electrik 5.x different from 4.x?',
                    'answer' => 'Version 5 is a rebuild on Electrik Slate 3 with code in the Electrik namespace, Cashier on teams, working subscribe flows, and honest install docs. APIs and migrations changed; treat 5.x as a new product line.',
                ],
                [
                    'question' => 'Does Electrik lock billing behind a paid tier?',
                    'answer' => 'No. Billing, teams, and permissions ship in the same source for everyone. Electrik 5.5+ is MIT — no paid feature unlock.',
                ],
            ],
        ],
        [
            'section' => 'Install and stack',
            'items' => [
                [
                    'question' => 'What are the requirements?',
                    'answer' => 'PHP 8.3+, Laravel 12+, Livewire 4, Tailwind CSS v4, and electrik/slate ^3.0. Stripe keys are required for live billing; test keys work locally.',
                ],
                [
                    'question' => 'How do I install Electrik?',
                    'answer' => 'Run composer require electrik/electrik:^5.5 on a Laravel app, then php artisan electrik:install. See the install guide on electrik.dev for migrations, assets, and Stripe sync.',
                ],
                [
                    'question' => 'Where is the UI documented?',
                    'answer' => 'Electrik Slate lives at slate.electrik.dev with components, blocks, examples, and themes. electrik.dev covers the product, license, and install path.',
                ],
            ],
        ],
        [
            'section' => 'License',
            'items' => [
                [
                    'question' => 'Is Electrik open source?',
                    'answer' => 'Yes. Electrik 5.5.0+ is MIT. Use it for personal or commercial projects without a paid kit license. Prefer composer require electrik/electrik:^5.5.',
                ],
                [
                    'question' => 'What about older BSL tags?',
                    'answer' => 'Tags that shipped under Business Source License 1.1 (for example v5.0.0) remain BSL for those releases. Upgrade to 5.5+ for MIT.',
                ],
                [
                    'question' => 'How do you make money?',
                    'answer' => 'Electrik Launch — fixed-price delivery ($6,900 / 14 days) where we ship your multi-tenant SaaS shell on Electrik. Solo/Studio kit licenses are retired.',
                ],
            ],
        ],
        [
            'section' => 'Billing and teams',
            'items' => [
                [
                    'question' => 'Who is the Stripe customer?',
                    'answer' => 'The team is the Cashier billable model by default. Subscriptions, payment methods, and invoices are scoped to the current team workspace.',
                ],
                [
                    'question' => 'Does Electrik support seat billing?',
                    'answer' => 'Yes. Seat counts can sync with team membership on supported plans. Configure plan features in config/electrik.php and Stripe price metadata.',
                ],
                [
                    'question' => 'Can I try a demo?',
                    'answer' => 'Use demo.electrik.dev when hosted, or run php artisan electrik:seed-demo locally for demo@electrik.dev with password password.',
                ],
            ],
        ],
    ];

    $flatFaqs = collect($faqs)->flatMap(fn ($group) => $group['items'])->values()->all();

    $seoTitle = 'FAQ';
    $seoDescription = 'Frequently asked questions about Electrik 5.x install, MIT licensing, teams, Stripe billing, and Slate 3.';
    $seoUrl = siteCanonicalUrl('/faq');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::faqPageGraph($seoUrl, $flatFaqs),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'FAQ', 'url' => siteCanonicalUrl('/faq')],
        ]),
    );
@endphp

@section('content')
<section class="site-page">
    <p class="home-eyebrow">FAQ</p>
    <h1 class="site-page-title mt-5">Frequently asked questions</h1>
    <p class="site-page-lead">Electrik 5.x, licensing, install, and billing.</p>

    <div class="mt-14 space-y-14">
        @foreach ($faqs as $group)
            <div>
                <h2 class="text-sm font-semibold tracking-[0.12em] text-[var(--home-muted)] uppercase">{{ $group['section'] }}</h2>
                <div class="mt-6 space-y-0">
                    @foreach ($group['items'] as $item)
                        <div class="border-b border-[var(--home-line)] py-6">
                            <h3 class="text-base font-semibold text-[var(--home-ink)]">{{ $item['question'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[var(--home-muted)]">{{ $item['answer'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
