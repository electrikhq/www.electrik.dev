@extends('layouts.www')

@section('content')
<section class="relative overflow-hidden px-4 pt-16 pb-12 sm:px-6 sm:pt-20 sm:pb-16">
    <div
        class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,color-mix(in_oklch,var(--slate-foreground)_8%,transparent),transparent)]"
        aria-hidden="true"
    ></div>
    <div class="mx-auto max-w-3xl text-center">
        <div class="mb-6 flex justify-center">
            <x-slate::badge variant="secondary">
                {{ config('site.version') }} on Laravel 12 + Slate 3
            </x-slate::badge>
        </div>

        <h1 class="text-4xl font-bold tracking-tight text-foreground sm:text-5xl lg:text-6xl">
            Ship your SaaS with teams, billing, and a real UI kit
        </h1>

        <p class="mx-auto mt-5 max-w-2xl text-[15px] leading-relaxed text-muted-foreground sm:text-base">
            Electrik is a Composer package for Laravel: auth, team workspaces, Stripe subscriptions, onboarding, and Slate 3 components.
            Full features in source. Honest BSL dual licensing for indie and commercial use.
        </p>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <x-slate::button as="a" href="{{ route('install') }}">
                Install guide
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                </svg>
            </x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                Live demo
            </x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ config('site.github_url') }}" target="_blank" rel="noopener noreferrer">
                GitHub
            </x-slate::button>
        </div>

        <div class="mt-10">
            <x-product-hunt-badge />
        </div>
    </div>

    <div class="mx-auto mt-12 max-w-5xl">
        <div class="overflow-hidden rounded-xl border border-border bg-card shadow-xs">
            <img
                src="{{ asset('images/electrik-dashboard.png') }}"
                alt="Electrik dashboard preview with sidebar, metrics, and team context"
                width="1600"
                height="900"
                class="w-full"
                fetchpriority="high"
                decoding="async"
            />
        </div>
    </div>
</section>

<section class="border-y border-border px-4 py-14 sm:px-6">
    <div class="mx-auto max-w-[1400px]">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-semibold tracking-tight">What’s in the package</h2>
            <p class="mt-3 text-muted-foreground">
                Full SaaS shell in Composer — not a feature-gated free tier.
            </p>
        </div>
        <ul class="mx-auto mt-10 grid max-w-4xl gap-x-10 gap-y-0 sm:grid-cols-2">
            @foreach (config('site.features') as $feature)
                <li class="border-t border-border py-4 text-sm leading-relaxed text-foreground">
                    {{ $feature }}
                </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-[1400px]">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-semibold tracking-tight">One ecosystem. One install path.</h2>
            <p class="mt-3 text-muted-foreground">
                Electrik is the SaaS kit. Slate is the UI it ships with. The demo proves both work together.
                You do not need a second starter kit or a mismatched admin theme.
            </p>
        </div>

        <div class="mt-10 grid gap-4 lg:grid-cols-3">
            @foreach (config('site.ecosystem') as $item)
                <div @class([
                    'flex flex-col border-t-2 border-border pt-6',
                    'border-foreground' => ! empty($item['primary']),
                ])>
                    <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">{{ $item['role'] }}</p>
                    <h3 class="mt-2 text-lg font-semibold tracking-tight text-foreground">{{ $item['name'] }}</h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-muted-foreground">{{ $item['summary'] }}</p>
                    <div class="mt-5">
                        @if (! empty($item['external']))
                            <x-slate::button
                                as="a"
                                size="sm"
                                variant="{{ ! empty($item['primary']) ? 'default' : 'outline' }}"
                                href="{{ $item['href'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {{ $item['cta'] }}
                            </x-slate::button>
                        @else
                            <x-slate::button
                                as="a"
                                size="sm"
                                variant="{{ ! empty($item['primary']) ? 'default' : 'outline' }}"
                                href="{{ url($item['href']) }}"
                            >
                                {{ $item['cta'] }}
                            </x-slate::button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <p class="mt-10 text-center text-sm text-muted-foreground">
            Also in the ecosystem
            <span class="mx-2 text-border" aria-hidden="true">·</span>
            @foreach (config('site.ecosystem_links') as $i => $link)
                @if ($i > 0)
                    <span class="mx-2 text-border" aria-hidden="true">·</span>
                @endif
                @if (! empty($link['external']))
                    <a href="{{ $link['href'] }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-4 hover:text-foreground">{{ $link['label'] }}</a>
                @else
                    <a href="{{ url($link['href']) }}" class="underline underline-offset-4 hover:text-foreground">{{ $link['label'] }}</a>
                @endif
            @endforeach
        </p>
    </div>
</section>

<section class="border-t border-border px-4 py-16 sm:px-6">
    <div class="mx-auto grid max-w-[1400px] items-center gap-10 lg:grid-cols-2">
        <div>
            <h2 class="text-2xl font-semibold tracking-tight">Built on tools you already use</h2>
            <p class="mt-3 text-muted-foreground">
                Laravel 12, Livewire 4, Tailwind CSS v4, Cashier, Spatie Permission, and Electrik Slate 3.
                Code stays in <code class="rounded bg-muted px-1.5 py-0.5 text-sm">vendor/Electrik</code>, not copied into your app on install.
            </p>
            <ul class="mt-6 space-y-2 text-sm text-foreground">
                <li class="flex items-start gap-2"><span class="text-muted-foreground">•</span> Team-scoped roles and Stripe customer on the team</li>
                <li class="flex items-start gap-2"><span class="text-muted-foreground">•</span> Working subscribe flow, webhooks, and plan sync</li>
                <li class="flex items-start gap-2"><span class="text-muted-foreground">•</span> Onboarding wizard, notifications, activity log, 2FA</li>
            </ul>
            <div class="mt-6">
                <x-slate::button as="a" variant="outline" href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer">
                    Slate component docs
                </x-slate::button>
            </div>
        </div>
        <div class="overflow-hidden rounded-xl border border-border bg-card shadow-xs">
            <img
                src="{{ asset('images/electrik-onboarding.png') }}"
                alt="Electrik onboarding wizard to create a team"
                width="1600"
                height="900"
                class="w-full"
                loading="lazy"
                decoding="async"
            />
        </div>
    </div>
</section>

<section class="border-t border-border bg-muted/20 px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-3xl text-center">
        <h2 class="text-2xl font-semibold tracking-tight">One feature surface. Two license lanes.</h2>
        <p class="mt-3 text-muted-foreground">
            We do not strip billing or teams from a free tier. The grant covers personal, educational, open-source, and pre-revenue indie use.
            Companies and client work need a commercial license. Same codebase either way.
        </p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <x-slate::card>
                <x-slate::card-header>
                    <x-slate::card-title>Additional Use Grant</x-slate::card-title>
                    <x-slate::card-description>Indies, learners, OSS, pre-revenue experiments</x-slate::card-description>
                </x-slate::card-header>
                <x-slate::card-content>
                    <p class="text-3xl font-bold tracking-tight">$0</p>
                    <p class="mt-2 text-sm text-muted-foreground">Full source and features</p>
                </x-slate::card-content>
            </x-slate::card>
            <x-slate::card>
                <x-slate::card-header>
                    <x-slate::card-title>Commercial license</x-slate::card-title>
                    <x-slate::card-description>Companies, agencies, client delivery, paid employment</x-slate::card-description>
                </x-slate::card-header>
                <x-slate::card-content>
                    <p class="text-3xl font-bold tracking-tight">Paid</p>
                    <p class="mt-2 text-sm text-muted-foreground">Solo $249 · Studio $599 · Agency custom</p>
                </x-slate::card-content>
            </x-slate::card>
        </div>
        <div class="mt-8">
            <x-slate::button as="a" href="{{ route('pricing') }}">See pricing and license details</x-slate::button>
        </div>
    </div>
</section>

<section class="border-t border-border px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-3xl text-center">
        <h2 class="text-2xl font-semibold tracking-tight">Electrik vs Jetstream, Spark, and peers</h2>
        <p class="mt-3 text-muted-foreground">
            Honest matrices: package vs scaffold, team billing, UI kit, and when the other product is the better fit.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <x-slate::button as="a" href="{{ route('compare.show', ['slug' => 'jetstream']) }}">vs Jetstream</x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ route('compare.show', ['slug' => 'spark']) }}">vs Spark</x-slate::button>
            <x-slate::button as="a" variant="ghost" href="{{ route('compare.index') }}">All comparisons</x-slate::button>
        </div>
    </div>
</section>

<x-product-hunt-review />

<x-newsletter-subscribe />

<x-slate-block::faq
    title="Common questions"
    :items="\App\Support\Seo::homepageFaqs()"
    :footer-href="route('faq')"
    footer-label="All FAQs"
/>

<x-slate-block::cta
    title="Building something? We can help"
    description="Electrik is built by {{ config('site.studio.name') }}, a Laravel product studio. If you have a SaaS or Laravel project and want a team that already ships this stack, get in touch."
    :primary-href="route('contact')"
    primary-label="Get in touch"
    :secondary-href="'mailto:'.config('site.studio.email').'?subject=Project%20inquiry'"
    secondary-label="Email us"
/>
@endsection
