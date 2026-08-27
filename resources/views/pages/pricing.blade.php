@extends('layouts.www')

@php
    $seoTitle = 'Pricing';
    $seoDescription = 'Electrik pricing: $0 under the BSL Additional Use Grant for indies, and commercial license tiers for companies and agencies.';
    $seoUrl = siteCanonicalUrl('/pricing');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Pricing', 'url' => siteCanonicalUrl('/pricing')],
        ]),
    );
@endphp

@section('content')
<section class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-2xl text-center">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Pricing</h1>
        <p class="mt-3 text-muted-foreground">
            Pay for permission when your use is commercial. Never pay to unlock billing or teams in source.
        </p>
    </div>

    <div class="mx-auto mt-10 grid max-w-3xl gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-border bg-muted/20 p-5">
            <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Choose the Grant if</p>
            <ul class="mt-3 space-y-2 text-sm text-foreground">
                <li>Personal learning or side projects</li>
                <li>Open-source</li>
                <li>Pre-revenue indie experiments</li>
            </ul>
        </div>
        <div class="rounded-xl border border-border bg-muted/20 p-5">
            <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Need commercial if</p>
            <ul class="mt-3 space-y-2 text-sm text-foreground">
                <li>Company or legal entity shipping a product</li>
                <li>Client, agency, or freelance delivery</li>
                <li>Internal business tools or paid employment use</li>
            </ul>
        </div>
    </div>

    <div class="mt-12 grid gap-6 lg:grid-cols-4">
        <x-slate::card class="lg:col-span-1 border-border/80">
            <x-slate::card-header>
                <x-slate::card-title>Grant</x-slate::card-title>
                <x-slate::card-description>Personal, OSS, pre-revenue indie</x-slate::card-description>
            </x-slate::card-header>
            <x-slate::card-content class="space-y-4">
                <p class="text-4xl font-bold tracking-tight">$0</p>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li>Full source and features</li>
                    <li>Auth, teams, Stripe billing</li>
                    <li>Community support via GitHub</li>
                </ul>
            </x-slate::card-content>
            <x-slate::card-footer>
                <x-slate::button as="a" class="w-full" href="{{ route('install') }}">Install</x-slate::button>
            </x-slate::card-footer>
        </x-slate::card>

        @foreach (config('site.commercial_tiers') as $tier)
            <x-slate::card @class([
                'border-border/80',
                'ring-2 ring-foreground/10' => ! empty($tier['highlight']),
            ])>
                <x-slate::card-header>
                    @if (! empty($tier['highlight']))
                        <x-slate::badge class="mb-2 w-fit">Popular</x-slate::badge>
                    @endif
                    <x-slate::card-title>{{ $tier['name'] }}</x-slate::card-title>
                    <x-slate::card-description>{{ $tier['summary'] }}</x-slate::card-description>
                </x-slate::card-header>
                <x-slate::card-content class="space-y-4">
                    <p class="text-4xl font-bold tracking-tight">
                        {{ $tier['price'] }}
                        @if (! empty($tier['period']))
                            <span class="text-sm font-normal text-muted-foreground">{{ $tier['period'] }}</span>
                        @endif
                    </p>
                    <ul class="space-y-2 text-sm text-muted-foreground">
                        @foreach ($tier['features'] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </x-slate::card-content>
                <x-slate::card-footer>
                    @php
                        $checkoutUrl = $tier['checkout_url'] ?? null;
                        $isCustom = ($tier['price'] ?? '') === 'Custom';
                        $ctaHref = filled($checkoutUrl)
                            ? $checkoutUrl
                            : 'mailto:'.config('site.commercial_email').'?subject='.rawurlencode('Electrik '.$tier['name'].' license');
                        $ctaLabel = $isCustom
                            ? 'Contact sales'
                            : (filled($checkoutUrl) ? 'Buy with Stripe' : 'Buy / invoice');
                    @endphp
                    <x-slate::button
                        as="a"
                        variant="{{ ! empty($tier['highlight']) ? 'default' : 'outline' }}"
                        class="w-full"
                        href="{{ $ctaHref }}"
                        :target="filled($checkoutUrl) ? '_blank' : null"
                        :rel="filled($checkoutUrl) ? 'noopener noreferrer' : null"
                    >
                        {{ $ctaLabel }}
                    </x-slate::button>
                </x-slate::card-footer>
            </x-slate::card>
        @endforeach
    </div>

    <div class="prose-site mx-auto mt-16 max-w-3xl">
        <h2>Which lane am I on?</h2>
        <p>
            Same codebase either way. The Additional Use Grant covers personal, educational, open-source, and pre-revenue indie use.
            Companies, client work, and paid employment need a commercial license.
            Read the full rules on the <a href="{{ route('license') }}">license page</a>.
        </p>

        <h2>Slate and blocks</h2>
        <p>
            <a href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer">Electrik Slate</a>
            and <code>electrik/slate-blocks</code> are separate <strong>MIT</strong> packages. This page prices Electrik (the SaaS kit), not the UI kit.
        </p>

        <h2>How this compares</h2>
        <p>
            Spark charges per project for billing alone. SaaSykit and Larafast charge $199 to $299 once for the whole kit, with no free commercial lane.
            Jetstream is MIT but has no billing. Electrik targets indies at $0 under the grant while still shipping Spark-class billing and team scope in the base package.
        </p>
        <p>
            Full feature matrices and “choose them if…” guidance:
            <a href="{{ route('compare.index') }}">Electrik vs alternatives</a>
            — Jetstream, Spark, Wave, SaaSykit, Larafast, and Filament alternatives compared side by side.
        </p>
        <p>
            Stripe subscription pricing for <em>your</em> product is separate. Electrik helps you bill your customers; the license above is for using Electrik itself.
        </p>
        <p class="text-sm text-muted-foreground">
            Solo and Studio can check out with Stripe when payment links are configured.
            Prefer an invoice? Email
            <a href="mailto:{{ config('site.commercial_email') }}">{{ config('site.commercial_email') }}</a>.
        </p>
    </div>
</section>
@endsection
