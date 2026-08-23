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
                    'answer' => 'No. Billing, teams, and permissions ship in the same source for grant and commercial users. The license gate is who may use the code commercially, not which features exist.',
                ],
            ],
        ],
        [
            'section' => 'Install and stack',
            'items' => [
                [
                    'question' => 'What are the requirements?',
                    'answer' => 'PHP 8.3+, Laravel 12+, Livewire 4, Tailwind CSS v4, and electrik/slate ^3.0@alpha. Stripe keys are required for live billing; test keys work locally.',
                ],
                [
                    'question' => 'How do I install Electrik?',
                    'answer' => 'Run composer require electrik/electrik:^5.0@alpha on a Laravel app, then php artisan electrik:install. See the install guide on electrik.dev for migrations, assets, and Stripe sync.',
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
                    'answer' => 'Source is public under BSL 1.1 with a free Additional Use Grant for personal, educational, open-source, and pre-revenue indie use. Commercial use by companies requires a paid license.',
                ],
                [
                    'question' => 'Can my startup use the free grant?',
                    'answer' => 'Pre-revenue indie experimentation by individuals or small informal teams qualifies. Once you are a company shipping a commercial product, raising as a legal entity, or doing client work, you need a commercial license.',
                ],
                [
                    'question' => 'When does it become Apache 2.0?',
                    'answer' => 'Four years after first public release, Electrik relicenses to Apache 2.0 automatically per the BSL change date in LICENSE.',
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
    $seoDescription = 'Frequently asked questions about Electrik 5.x install, BSL licensing, teams, Stripe billing, and Slate 3.';
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
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
    <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Frequently asked questions</h1>
    <p class="mt-3 text-muted-foreground">Electrik 5.x, licensing, install, and billing.</p>

    <div class="mt-12 space-y-12">
        @foreach ($faqs as $group)
            <div>
                <h2 class="text-lg font-semibold text-foreground">{{ $group['section'] }}</h2>
                <div class="mt-6 space-y-8">
                    @foreach ($group['items'] as $item)
                        <div>
                            <h3 class="text-base font-medium text-foreground">{{ $item['question'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $item['answer'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
