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
                    <p class="text-4xl font-bold tracking-tight">{{ $tier['price'] }}</p>
                    <ul class="space-y-2 text-sm text-muted-foreground">
                        @foreach ($tier['features'] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </x-slate::card-content>
                <x-slate::card-footer>
                    <x-slate::button as="a" variant="{{ ! empty($tier['highlight']) ? 'default' : 'outline' }}" class="w-full" href="mailto:{{ config('site.commercial_email') }}?subject=Electrik%20{{ $tier['name'] }}%20license">
                        Contact sales
                    </x-slate::button>
                </x-slate::card-footer>
            </x-slate::card>
        @endforeach
    </div>

    <div class="prose-site mx-auto mt-16 max-w-3xl">
        <h2>How this compares</h2>
        <p>
            Spark charges per project for billing alone. SaaSykit and Larafast charge $199 to $299 once for the whole kit, with no free commercial lane.
            Jetstream is MIT but has no billing. Electrik targets indies at $0 under the grant while still shipping Spark-class billing and team scope in the base package.
        </p>
        <p>
            Stripe subscription pricing for <em>your</em> product is separate. Electrik helps you bill your customers; the license above is for using Electrik itself.
        </p>
    </div>
</section>
@endsection
