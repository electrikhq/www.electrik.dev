@extends('layouts.www')

@php
    $seoTitle = 'Pricing';
    $seoDescription = 'Electrik is MIT and free. Paid option: Electrik Launch — we ship your multi-tenant Laravel SaaS shell in 14 days for $6,900.';
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
<section class="site-page site-page--wide">
    <div class="mx-auto max-w-2xl text-center">
        <p class="home-eyebrow justify-center">Pricing</p>
        <h1 class="site-page-title mt-5">Free kit. Paid delivery.</h1>
        <p class="site-page-lead">
            Electrik is MIT open source — install and ship commercially without a kit license.
            Need it built for you? Electrik Launch is the paid path.
        </p>
    </div>

    <div class="mx-auto mt-12 grid max-w-4xl gap-6 md:grid-cols-2">
        <x-slate::card id="oss" class="scroll-mt-24 border-border/80">
            <x-slate::card-header>
                <x-slate::badge class="mb-2 w-fit">Open source</x-slate::badge>
                <x-slate::card-title>Electrik</x-slate::card-title>
                <x-slate::card-description>Composer package — MIT</x-slate::card-description>
            </x-slate::card-header>
            <x-slate::card-content class="space-y-4">
                <p class="text-4xl font-bold tracking-tight">$0</p>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li>Auth, teams, Stripe on the team, Slate UI</li>
                    <li>Personal or commercial use</li>
                    <li>Community support via GitHub</li>
                    <li>Prefer <code class="text-xs">^5.5</code> for MIT (older tags may be BSL)</li>
                </ul>
            </x-slate::card-content>
            <x-slate::card-footer>
                <x-slate::button as="a" variant="outline" class="w-full" href="{{ route('install') }}">Install</x-slate::button>
            </x-slate::card-footer>
        </x-slate::card>

        <x-slate::card id="launch" class="scroll-mt-24 ring-2 ring-foreground/15">
            <x-slate::card-header>
                <x-slate::badge class="mb-2 w-fit">Paid delivery</x-slate::badge>
                <x-slate::card-title>Electrik Launch</x-slate::card-title>
                <x-slate::card-description>We ship your multi-tenant SaaS shell</x-slate::card-description>
            </x-slate::card-header>
            <x-slate::card-content class="space-y-4">
                <p class="text-4xl font-bold tracking-tight">
                    $6,900
                    <span class="text-sm font-normal text-muted-foreground">/ 14 days</span>
                </p>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li>Auth, teams, Stripe, branding, one core feature</li>
                    <li>Deploy + handoff — you own the code</li>
                    <li>Built on Electrik so plumbing is not reinvented</li>
                </ul>
            </x-slate::card-content>
            <x-slate::card-footer>
                <x-slate::button as="a" class="w-full" href="{{ route('launch') }}">See Launch</x-slate::button>
            </x-slate::card-footer>
        </x-slate::card>
    </div>

    <div class="prose-site mx-auto mt-16 max-w-3xl">
        <h2>What about Solo / Studio licenses?</h2>
        <p>
            Retired. No more paid kit licenses. The package is MIT.
            If you previously bought a commercial license, email
            <a href="mailto:{{ config('site.commercial_email') }}">{{ config('site.commercial_email') }}</a>
            and we will honor it.
        </p>

        <h2>License details</h2>
        <p>
            Full MIT text and notes on older BSL tags:
            <a href="{{ route('license') }}">License</a>.
        </p>
    </div>
</section>
@endsection
