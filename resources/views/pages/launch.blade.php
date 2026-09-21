@extends('layouts.www')

@php
    $studio = config('site.studio');
    $seoTitle = 'Electrik Launch';
    $seoDescription = 'Fixed-price Laravel SaaS launch: auth, teams, Stripe, Slate UI, and one core feature in 14 days for $6,900. Built on Electrik. You own the code.';
    $seoUrl = siteCanonicalUrl('/launch');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Launch', 'url' => siteCanonicalUrl('/launch')],
        ]),
    );
@endphp

@section('content')
<section class="site-page site-page--wide">
    <div class="mx-auto max-w-2xl text-center">
        <p class="home-eyebrow justify-center">Productized build</p>
        <h1 class="site-page-title mt-5">Electrik Launch</h1>
        <p class="site-page-lead">
            Live multi-tenant Laravel SaaS in 14 days. Auth, teams, Stripe on the team, Slate UI, branding, one core feature, deploy, handoff. You own the code.
        </p>
        <p class="mt-6 text-4xl font-bold tracking-tight text-[var(--home-ink)]">$6,900</p>
        <p class="mt-2 text-sm text-muted-foreground">14 calendar days · 50% deposit · you own the code (MIT kit)</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <x-slate::button as="a" href="mailto:{{ $studio['email'] }}?subject=Electrik%20Launch%20inquiry">
                Start Electrik Launch
            </x-slate::button>
            <x-slate::button as="a" variant="outline" href="https://demo.electrik.dev" target="_blank" rel="noopener noreferrer">
                See the shell
            </x-slate::button>
        </div>
    </div>

    <div class="mx-auto mt-16 grid max-w-4xl gap-8 lg:grid-cols-2">
        <div>
            <h2 class="text-lg font-semibold text-[var(--home-ink)]">Included</h2>
            <ul class="mt-4 space-y-3 text-sm leading-relaxed text-muted-foreground">
                <li>Laravel + Electrik 5.4 + Slate 3 on your hosting (or Forge/Fly we set up)</li>
                <li>Auth, teams, invites, roles, Stripe Cashier on the team (test mode wired)</li>
                <li>Brand: logo, primary color, app name</li>
                <li>One core product resource (CRUD + team scope)</li>
                <li>Dashboard shell + onboarding pass</li>
                <li>Staging + production checklist · 60-min handoff + short Loom</li>
                <li>Electrik Studio commercial license for that product</li>
            </ul>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-[var(--home-ink)]">Out of scope</h2>
            <ul class="mt-4 space-y-3 text-sm leading-relaxed text-muted-foreground">
                <li>Mobile apps, React/Inertia rewrite</li>
                <li>Custom design system (Slate only)</li>
                <li>Legacy migrations, WhatsApp, heavy AI agents</li>
                <li>Content, SEO campaigns, paid ads</li>
                <li>More than one core resource (use Launch+ at $9,900 / 21 days)</li>
            </ul>
            <p class="mt-8 text-sm leading-relaxed text-muted-foreground">
                Optional retain after handoff: <strong class="text-foreground">$1,500/mo</strong> (cap 8h) for bugs and small changes.
            </p>
        </div>
    </div>

    <div class="mx-auto mt-16 max-w-2xl rounded-xl border border-border bg-muted/20 p-6 sm:p-8">
        <h2 class="text-lg font-semibold text-[var(--home-ink)]">Done when</h2>
        <p class="mt-3 text-sm leading-relaxed text-muted-foreground">
            You can register → create a team → invite a member → see your branded shell → use the one CRUD → open billing in Stripe test mode.
        </p>
        <p class="mt-4 text-sm leading-relaxed text-muted-foreground">
            Sold by <a href="{{ $studio['url'] }}" class="font-medium text-foreground underline underline-offset-4" target="_blank" rel="noopener noreferrer">{{ $studio['name'] }}</a>
            (studio behind Electrik). Prefer to build yourself?
            <a href="{{ route('install') }}" class="font-medium text-foreground underline underline-offset-4">Install the MIT kit free</a>.
        </p>
        <div class="mt-6">
            <x-slate::button as="a" href="mailto:{{ $studio['email'] }}?subject=Electrik%20Launch%20inquiry">
                Email Launch inquiry
            </x-slate::button>
        </div>
    </div>
</section>
@endsection
