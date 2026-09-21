@extends('layouts.www')

@section('content')
@php
    $composerInstall = 'composer require electrik/electrik:^5.5';
    $agentPrompt = <<<'PROMPT'
Install Electrik 5.x as a Composer package.
Read https://electrik.dev/llms.txt and https://electrik.dev/docs/getting-started/ai first.
Keep the shell in vendor; put product code in App\. Do not dump Jetstream/Breeze-style auth into App\.
PROMPT;
    $studioName = config('site.studio.name');
    $studioUrl = config('site.studio.url');
    $ph = config('product-hunt.review');
    $stack = [
        ['mark' => 'Lv', 'name' => 'Laravel 12'],
        ['mark' => 'Lw', 'name' => 'Livewire 4'],
        ['mark' => 'St', 'name' => 'Stripe Cashier'],
        ['mark' => 'Sp', 'name' => 'Spatie Permission'],
        ['mark' => 'Tw', 'name' => 'Tailwind CSS v4'],
        ['mark' => 'Sl', 'name' => 'Electrik Slate 3'],
        ['mark' => 'Pk', 'name' => 'Packagist'],
        ['mark' => 'Cp', 'name' => 'Composer'],
        ['mark' => 'Gh', 'name' => 'GitHub'],
    ];
@endphp

{{-- Hero --}}
<section class="home-dot-canvas border-b border-[var(--home-line)] px-4 pb-16 pt-12 sm:px-6 sm:pb-24 sm:pt-16 lg:pt-20">
    <div class="home-wrap">
        <div class="mx-auto max-w-3xl text-center">
            <p class="home-eyebrow justify-center">Electrik {{ config('site.version') }} · Laravel SaaS kit</p>
            <h1 class="home-display mt-5 text-4xl sm:text-5xl lg:text-[3.5rem]">
                Ship Laravel SaaS without rebuilding teams and billing again
            </h1>
            <p class="home-lead mx-auto mt-5 max-w-2xl">
                Auth, team workspaces, Stripe on the team, onboarding, and Slate UI —
                as a Composer package. Your <code class="rounded bg-black/5 px-1.5 py-0.5 font-mono text-[0.9em] text-[var(--home-ink)]">App\</code> stays clean.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <x-slate::button as="a" size="lg" href="{{ route('install') }}">
                    Install free — MIT
                </x-slate::button>
                <x-slate::button as="a" variant="outline" size="lg" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                    Try the live demo
                </x-slate::button>
                <x-slate::button as="a" variant="outline" size="lg" href="{{ route('launch') }}">
                    Electrik Launch
                </x-slate::button>
            </div>
            <p class="mt-4 text-sm text-[var(--home-muted)]">
                MIT open source · Launch $6,900 / 14 days if you want us to ship it
            </p>
            <p class="mt-6" x-data="{ copied: false, text: @js($composerInstall) }">
                <button
                    type="button"
                    class="inline-flex items-center gap-3 rounded-xl border border-[var(--home-line)] bg-white px-4 py-3 font-mono text-sm text-[var(--home-ink)] shadow-sm transition hover:border-black/20"
                    x-on:click="navigator.clipboard.writeText(text).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                >
                    <span x-text="text"></span>
                    <span class="text-xs text-[var(--home-muted)]" x-text="copied ? 'copied' : 'copy'"></span>
                </button>
            </p>
            <p class="mt-4 text-sm text-[var(--home-muted)]">
                Using Cursor or Claude?
                <a href="#install-with-agents" class="font-medium text-[var(--home-ink)] underline underline-offset-4">Paste an agent prompt</a>
            </p>
        </div>

        <div class="home-stage mx-auto mt-12 max-w-5xl sm:mt-14">
            <div class="home-stage-ghost" aria-hidden="true"></div>
            <div class="home-stage-frame">
                <div class="home-stage-chrome">
                    <span class="home-stage-dot"></span>
                    <span class="home-stage-dot"></span>
                    <span class="home-stage-dot"></span>
                    <span class="ms-2 text-xs text-[var(--home-muted)]">electrik · team dashboard</span>
                </div>
                <img
                    src="{{ asset('images/electrik-dashboard.png') }}"
                    alt="Electrik team dashboard"
                    width="1600"
                    height="900"
                    fetchpriority="high"
                    decoding="async"
                />
            </div>
        </div>
    </div>
</section>

{{-- Proof --}}
<section class="border-b border-[var(--home-line)] px-4 py-14 sm:px-6">
    <div class="mx-auto max-w-3xl text-center">
        <p class="text-xs font-semibold tracking-[0.14em] text-[var(--home-muted)] uppercase">Used in production</p>
        <p class="mt-4 text-lg leading-relaxed text-[var(--home-ink)] sm:text-xl">
            Every client Laravel SaaS from
            <a href="{{ $studioUrl }}" class="font-semibold underline underline-offset-4" target="_blank" rel="noopener noreferrer">{{ $studioName }}</a>
            ships on Electrik — teams, billing shell, and Slate included.
        </p>
    </div>
</section>

{{-- Agent DX — early, loud, not hero --}}
<section id="install-with-agents" class="scroll-mt-24 border-b border-[var(--home-line)] bg-[var(--home-soft)] px-4 py-20 sm:px-6 sm:py-28 lg:py-32">
    <div class="mx-auto grid w-full max-w-6xl items-start gap-12 lg:grid-cols-2 lg:gap-20 lg:items-center">
        <div class="max-w-xl">
            <p class="home-eyebrow">Agent DX</p>
            <h2 class="home-display mt-6 text-3xl sm:text-4xl lg:text-[2.75rem]">
                Built for Cursor and Claude — not just humans
            </h2>
            <p class="home-lead mt-6">
                AGENTS.md, llms.txt, and a Cursor skill teach coding agents to
                <code class="rounded bg-black/5 px-1.5 py-0.5 font-mono text-[0.9em] text-[var(--home-ink)]">composer require</code>
                Electrik, run the installer, and keep the shell in vendor.
                Same package either way — agents just install it correctly.
            </p>
            <ul class="mt-10 space-y-4 text-sm leading-relaxed text-[var(--home-ink)]">
                <li class="flex gap-3"><span class="mt-0.5 text-[var(--home-accent)]">→</span> Paste one prompt into Cursor / Claude</li>
                <li class="flex gap-3"><span class="mt-0.5 text-[var(--home-accent)]">→</span> Agent reads docs + AGENTS.md before touching App\</li>
                <li class="flex gap-3"><span class="mt-0.5 text-[var(--home-accent)]">→</span> Auth, teams, and billing stay in vendor</li>
            </ul>
            <div class="mt-10 flex flex-wrap gap-3">
                <x-slate::button as="a" variant="outline" href="{{ url('/docs/getting-started/ai') }}">
                    Agent install docs
                </x-slate::button>
                <x-slate::button as="a" variant="ghost" href="{{ route('install') }}">
                    Human install guide
                </x-slate::button>
            </div>
        </div>

        <div
            class="overflow-hidden rounded-2xl border border-black/10 bg-[#0a0a0a] text-white shadow-[0_28px_70px_-36px_rgba(0,0,0,0.5)]"
            x-data="{ copied: false, text: @js($agentPrompt) }"
        >
            <div class="flex items-center justify-between gap-4 border-b border-white/10 px-5 py-4 sm:px-6">
                <p class="text-xs font-semibold tracking-[0.12em] text-white/60 uppercase">Agent prompt</p>
                <button
                    type="button"
                    class="shrink-0 rounded-lg bg-white px-3.5 py-2 text-xs font-semibold text-[#0a0a0a] transition hover:bg-white/90"
                    x-on:click="navigator.clipboard.writeText(text).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                >
                    <span x-text="copied ? 'Copied' : 'Copy prompt'"></span>
                </button>
            </div>
            <pre class="overflow-x-auto px-5 py-6 font-mono text-[13px] leading-7 whitespace-pre-wrap text-[#e8e8e6] sm:px-6 sm:text-sm">{{ $agentPrompt }}</pre>
            <div class="border-t border-white/10 px-5 py-4 text-xs leading-relaxed text-white/50 sm:px-6">
                Optional path — demo and <code class="text-white/75">composer require</code> still work without an agent.
            </div>
        </div>
    </div>
</section>

{{-- Pain --}}
<section class="home-section border-b border-[var(--home-line)]">
    <div class="home-wrap">
        <div class="mx-auto max-w-2xl text-center">
            <p class="home-eyebrow justify-center">The problem</p>
            <h2 class="home-display mt-5 text-3xl sm:text-4xl lg:text-5xl">
                Stop gluing Jetstream, Spark, and a theme
            </h2>
            <p class="home-lead mt-5">
                Most Laravel SaaS starts as four weekends of the same setup.
                Electrik <span class="text-[var(--home-ink)]">is</span> the setup — one package, not a dump into App\.
            </p>
        </div>
        <div class="mx-auto mt-16 grid max-w-3xl gap-12 sm:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-[var(--home-muted)]">Without Electrik</p>
                <ul class="mt-5 space-y-4 text-[var(--home-muted)]">
                    <li>Jetstream or Breeze for auth</li>
                    <li>Hand-roll teams and roles</li>
                    <li>Spark or DIY Cashier</li>
                    <li>A mismatched admin theme</li>
                    <li>Starter code rotting in App\</li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-semibold text-[var(--home-ink)]">With Electrik</p>
                <ul class="mt-5 space-y-4 text-[var(--home-ink)]">
                    <li>Auth, sessions, profile, 2FA</li>
                    <li>Team workspaces + Spatie roles</li>
                    <li>Stripe customer on the team</li>
                    <li>Slate 3 UI in the kit</li>
                    <li><code class="rounded bg-black/5 px-1.5 py-0.5 font-mono text-xs">composer require</code> — stays in vendor</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Feature: teams --}}
<section class="home-section border-b border-[var(--home-line)]">
    <div class="home-wrap grid items-center gap-14 lg:grid-cols-2 lg:gap-20">
        <div>
            <p class="home-eyebrow">Teams</p>
            <h2 class="home-display mt-5 text-3xl sm:text-4xl">Workspaces that match real SaaS</h2>
            <p class="home-lead mt-5">
                Create and switch teams, invite members, Spatie roles scoped to the workspace.
                Your product attaches to the team — not a solo-user afterthought.
            </p>
            <div class="mt-8">
                <x-slate::button as="a" variant="outline" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                    See teams in the demo
                </x-slate::button>
            </div>
        </div>
        <div class="home-feature-art">
            <div class="home-feature-art-bg">
                <img
                    src="{{ asset('images/electrik-onboarding.png') }}"
                    alt="Electrik onboarding and teams"
                    class="w-full"
                    loading="lazy"
                    decoding="async"
                />
            </div>
            <div class="home-float-card home-float-card--a">
                <p class="text-[0.65rem] font-semibold tracking-[0.12em] text-[var(--home-muted)] uppercase">Team</p>
                <p class="mt-1 text-sm font-semibold text-[var(--home-ink)]">Invite · roles · switch</p>
                <p class="mt-1 text-xs leading-relaxed text-[var(--home-muted)]">Spatie permissions, team-scoped from install.</p>
            </div>
        </div>
    </div>
</section>

{{-- Feature: billing --}}
<section class="home-section border-b border-[var(--home-line)] bg-[var(--home-soft)]">
    <div class="home-wrap grid items-center gap-14 lg:grid-cols-2 lg:gap-20">
        <div class="home-feature-art lg:order-1">
            <div class="home-feature-art-bg">
                <img
                    src="{{ asset('images/electrik-dashboard.png') }}"
                    alt="Electrik dashboard with billing context"
                    class="w-full"
                    loading="lazy"
                    decoding="async"
                />
            </div>
            <div class="home-float-card home-float-card--b">
                <p class="text-[0.65rem] font-semibold tracking-[0.12em] text-[var(--home-muted)] uppercase">Billing</p>
                <p class="mt-1 text-sm font-semibold text-[var(--home-ink)]">Cashier on the team</p>
                <p class="mt-1 text-xs leading-relaxed text-[var(--home-muted)]">Subscribe, portal, webhooks — B2B-shaped.</p>
            </div>
            <div class="home-float-card home-float-card--c hidden lg:block">
                <p class="text-[0.65rem] font-semibold tracking-[0.12em] text-[var(--home-muted)] uppercase">UI</p>
                <p class="mt-1 text-sm font-semibold text-[var(--home-ink)]">Slate 3 shell</p>
                <p class="mt-1 text-xs leading-relaxed text-[var(--home-muted)]">Components matched to the product, not bolted on.</p>
            </div>
        </div>
        <div class="lg:order-2">
            <p class="home-eyebrow">Billing + UI</p>
            <h2 class="home-display mt-5 text-3xl sm:text-4xl">Stripe on the team. Slate in the kit.</h2>
            <p class="home-lead mt-5">
                The Cashier customer is the team — the shape most B2B Laravel SaaS need.
                Screens ship on Electrik Slate 3 so auth, billing, and product UI share one system.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <x-slate::button as="a" href="{{ route('install') }}">Install free</x-slate::button>
                <x-slate::button as="a" variant="outline" href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer">Slate UI</x-slate::button>
            </div>
        </div>
    </div>
</section>

{{-- Package purity --}}
<section class="home-section border-b border-[var(--home-line)]">
    <div class="home-wrap">
        <div class="mx-auto max-w-2xl text-center">
            <p class="home-eyebrow justify-center">Architecture</p>
            <h2 class="home-display mt-5 text-3xl sm:text-4xl lg:text-5xl">
                No boilerplate dump. Lean package architecture.
            </h2>
            <p class="home-lead mt-5">
                Other kits clone into your app. Electrik lives in vendor.
                Customize via config, env, and published views — not by owning hundreds of kit files forever.
            </p>
        </div>
        <div class="mt-16 grid gap-6 lg:grid-cols-2">
            <div class="home-tree rounded-2xl border border-[var(--home-line)] bg-[var(--home-soft)] p-6 sm:p-8">
                <p class="mb-5 text-xs font-semibold tracking-[0.12em] text-[var(--home-muted)] uppercase">Typical starter dump</p>
                <pre class="font-mono text-[13px] leading-7 text-[var(--home-muted)] whitespace-pre">app/
├── Actions/Fortify/…
├── Models/User.php   ← kit forever
├── Http/…
└── …hundreds of kit files

resources/views/
└── …auth, teams, billing copies</pre>
            </div>
            <div class="home-tree rounded-2xl border border-black/10 bg-white p-6 shadow-[0_24px_60px_-40px_rgba(0,0,0,0.35)] sm:p-8">
                <p class="mb-5 text-xs font-semibold tracking-[0.12em] text-[var(--home-ink)] uppercase">With Electrik</p>
                <pre class="font-mono text-[13px] leading-7 text-[var(--home-ink)] whitespace-pre">app/
├── Models/…          ← your product
├── Http/…            ← your product
└── …

vendor/electrik/
└── electrik/         ← auth, teams, billing

composer require → electrik:install → build</pre>
            </div>
        </div>
    </div>
</section>

{{-- Stack / integrations --}}
<section class="scroll-mt-24 border-b border-[var(--home-line)] px-4 py-20 sm:px-6 sm:py-28 lg:py-32">
    <div class="mx-auto grid w-full max-w-6xl items-center gap-14 lg:grid-cols-2 lg:gap-24">
        <div class="max-w-xl">
            <p class="home-eyebrow">Stack</p>
            <h2 class="home-display mt-6 text-3xl sm:text-4xl lg:text-[2.75rem]">Works with the Laravel tools you already use</h2>
            <p class="home-lead mt-6">
                Built on Laravel 12, Livewire, Cashier, Spatie Permission, and Tailwind —
                with Electrik Slate as the UI system. Install from Packagist like any other package.
            </p>
            <div class="mt-10 flex flex-wrap gap-3">
                <x-slate::button as="a" href="{{ route('install') }}">Install guide</x-slate::button>
                <x-slate::button as="a" variant="outline" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">View demo</x-slate::button>
            </div>
        </div>
        <div class="home-integ">
            @foreach ($stack as $item)
                <div class="home-integ-item">
                    <span class="home-integ-mark">{{ $item['mark'] }}</span>
                    <span>{{ $item['name'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Testimonial / proof quote --}}
<section class="home-section border-b border-[var(--home-line)] home-dot-canvas">
    <div class="home-wrap">
        <div class="home-quote-frame grid gap-10 p-8 sm:p-12 lg:grid-cols-[1.4fr_0.8fr] lg:items-center lg:gap-16 lg:p-16">
            <div>
                <p class="text-xs font-semibold tracking-[0.16em] text-[var(--home-muted)] uppercase">{{ $studioName }}</p>
                <blockquote class="mt-6 text-2xl leading-snug font-semibold tracking-tight text-[var(--home-ink)] sm:text-3xl lg:text-[2rem] lg:leading-[1.25]">
                    “We don’t reinvent auth, teams, and billing for each client.
                    <span class="home-mark">Every Laravel SaaS we ship runs on Electrik</span>
                    — package in vendor, product in App\.”
                </blockquote>
                <p class="mt-8 text-sm text-[var(--home-ink)]">
                    <span class="font-semibold">{{ $studioName }}</span>
                    <span class="text-[var(--home-muted)]"> · Studio that builds Electrik — and ships client work on it</span>
                </p>
            </div>
            <div class="flex h-full min-h-48 items-center justify-center rounded-xl bg-[var(--home-soft)] p-10">
                <div class="text-center">
                    <img src="{{ asset('images/electrik-mark.svg') }}" alt="" class="mx-auto h-14 w-14 opacity-90" />
                    <p class="mt-4 font-display text-xl font-semibold tracking-tight">Electrik</p>
                    <p class="mt-1 text-sm text-[var(--home-muted)]">Production shell</p>
                </div>
            </div>
        </div>

        @if (! empty($ph['body']))
            <div class="mx-auto mt-12 max-w-3xl border-t border-[var(--home-line)] pt-10">
                <p class="text-lg leading-relaxed text-[var(--home-ink)]">
                    “{{ $ph['body'] }}”
                </p>
                <p class="mt-4 text-sm text-[var(--home-muted)]">
                    {{ $ph['author'] ?? 'Founder' }}
                    @if (! empty($ph['role'])) · {{ $ph['role'] }} @endif
                    ·
                    <a href="{{ config('product-hunt.reviews_url') }}" class="underline underline-offset-4" target="_blank" rel="noopener noreferrer">Product Hunt</a>
                </p>
            </div>
        @endif
    </div>
</section>

{{-- Install --}}
<section id="install" class="home-section scroll-mt-24 border-b border-[var(--home-line)]">
    <div class="home-wrap grid items-center gap-14 lg:grid-cols-2 lg:gap-16">
        <div>
            <p class="home-eyebrow">Install</p>
            <h2 class="home-display mt-5 text-3xl sm:text-4xl">Require. Install. Open the app.</h2>
            <p class="home-lead mt-5">
                Hours of glue become a package and an installer. Wire Stripe keys, then build product.
            </p>
            <ol class="mt-10 space-y-0 text-sm text-[var(--home-ink)]">
                <li class="flex gap-4 border-b border-[var(--home-line)] py-4">
                    <span class="font-mono text-[var(--home-muted)]">1</span>
                    <code class="rounded bg-black/5 px-1.5 py-0.5 font-mono text-xs">composer require electrik/electrik</code>
                </li>
                <li class="flex gap-4 border-b border-[var(--home-line)] py-4">
                    <span class="font-mono text-[var(--home-muted)]">2</span>
                    <code class="rounded bg-black/5 px-1.5 py-0.5 font-mono text-xs">php artisan electrik:install --migrate --force</code>
                </li>
                <li class="flex gap-4 border-b border-[var(--home-line)] py-4">
                    <span class="font-mono text-[var(--home-muted)]">3</span>
                    <span>Onboarding → team dashboard</span>
                </li>
            </ol>
            <div class="mt-8 flex flex-wrap gap-3">
                <x-slate::button as="a" href="{{ route('install') }}">Full install guide</x-slate::button>
                <x-slate::button as="a" variant="outline" href="https://clipy.online/video/5rpdlm7ajzs5" target="_blank" rel="noopener noreferrer">
                    Watch install
                </x-slate::button>
            </div>
        </div>
        <div class="home-stage-frame overflow-hidden">
            <div class="aspect-video w-full bg-black">
                <iframe
                    class="h-full w-full"
                    src="https://clipy.online/embed/5rpdlm7ajzs5"
                    title="Electrik install walkthrough"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </div>
</section>

{{-- Big pricing --}}
<section id="pricing" class="home-section border-b border-[var(--home-line)] home-dot-canvas">
    <div class="home-wrap">
        <div class="mx-auto max-w-2xl text-center">
            <p class="home-eyebrow justify-center">Pricing</p>
            <h2 class="home-display mt-5 text-3xl sm:text-4xl lg:text-5xl">
                Free kit. Paid delivery.
            </h2>
            <p class="home-lead mt-5">
                Electrik is MIT — install and ship commercially without a kit license.
                Need it built for you? Electrik Launch is the paid path.
            </p>
        </div>

        <div class="home-price-band mx-auto mt-14 max-w-3xl text-center">
            <p class="text-sm font-semibold text-[var(--home-ink)]">Electrik Launch — we ship your SaaS shell</p>
            <p class="home-price-num mt-4">$6,900</p>
            <p class="home-price-meta">14 days · 50% deposit · you own the code</p>
            <p class="mx-auto mt-5 max-w-md text-sm leading-relaxed text-[var(--home-muted)]">
                Auth, teams, Stripe, branding, one core feature, deploy, handoff. Built on Electrik.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <x-slate::button as="a" size="lg" href="{{ route('launch') }}">See Launch</x-slate::button>
                <x-slate::button as="a" variant="outline" size="lg" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                    Try demo first
                </x-slate::button>
            </div>
            <p class="mt-8 border-t border-black/10 pt-6 text-sm text-[var(--home-muted)]">
                Prefer DIY?
                <a href="{{ route('install') }}" class="font-medium text-[var(--home-ink)] underline underline-offset-4">Install MIT free</a>
                · details on <a href="{{ route('pricing') }}" class="font-medium text-[var(--home-ink)] underline underline-offset-4">Pricing</a>.
            </p>
        </div>

        <div class="home-price-lanes mx-auto max-w-4xl">
            <div class="home-price-lane">
                <p class="text-sm font-semibold text-[var(--home-ink)]">Electrik · MIT · $0</p>
                <p class="mt-2 text-sm leading-relaxed text-[var(--home-muted)]">Personal or commercial. Full source. Prefer ^5.5.</p>
                <a href="{{ route('install') }}" class="mt-4 inline-block text-sm font-medium underline underline-offset-4">Install</a>
            </div>
            <div class="home-price-lane">
                <p class="text-sm font-semibold text-[var(--home-ink)]">Electrik Launch · $6,900</p>
                <p class="mt-2 text-sm leading-relaxed text-[var(--home-muted)]">We ship your multi-tenant SaaS shell + one feature in 14 days.</p>
                <a href="{{ route('launch') }}" class="mt-4 inline-block text-sm font-medium underline underline-offset-4">See Launch</a>
            </div>
            <div class="home-price-lane">
                <p class="text-sm font-semibold text-[var(--home-ink)]">License</p>
                <p class="mt-2 text-sm leading-relaxed text-[var(--home-muted)]">MIT for 5.5+. Older tags may still be BSL.</p>
                <a href="{{ route('license') }}" class="mt-4 inline-block text-sm font-medium underline underline-offset-4">Read license</a>
            </div>
        </div>
    </div>
</section>

{{-- Compare --}}
<section class="home-section border-b border-[var(--home-line)]">
    <div class="home-wrap max-w-3xl text-center">
        <h2 class="home-display text-3xl sm:text-4xl">Evaluating Jetstream or Spark?</h2>
        <p class="home-lead mt-5">
            Honest matrices on compare pages — when Electrik fits, and when the other product is better.
        </p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
            <x-slate::button as="a" variant="outline" href="{{ route('compare.show', ['slug' => 'jetstream']) }}">vs Jetstream</x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ route('compare.show', ['slug' => 'spark']) }}">vs Spark</x-slate::button>
            <x-slate::button as="a" variant="ghost" href="{{ route('compare.index') }}">All comparisons</x-slate::button>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="home-section border-b border-[var(--home-line)] bg-[var(--home-soft)]">
    <div class="home-wrap max-w-3xl">
        <div class="text-center">
            <h2 class="home-display text-3xl sm:text-4xl">Common questions</h2>
            <p class="home-lead mt-4">MIT license, install, vendor customization, Launch.</p>
        </div>
        <div class="mt-12 space-y-0">
            @foreach (\App\Support\Seo::homepageFaqs() as $item)
                <details class="group border-b border-[var(--home-line)] py-5">
                    <summary class="cursor-pointer list-none text-left text-base font-semibold text-[var(--home-ink)] marker:content-none [&::-webkit-details-marker]:hidden">
                        <span class="flex items-start justify-between gap-4">
                            {{ $item['question'] }}
                            <span class="text-[var(--home-muted)] transition group-open:rotate-45">+</span>
                        </span>
                    </summary>
                    <p class="mt-3 pr-8 text-sm leading-relaxed text-[var(--home-muted)]">{{ $item['answer'] }}</p>
                </details>
            @endforeach
        </div>
        <p class="mt-8 text-center text-sm">
            <a href="{{ route('faq') }}" class="underline underline-offset-4 text-[var(--home-muted)] hover:text-[var(--home-ink)]">All FAQs</a>
        </p>
    </div>
</section>

{{-- Close --}}
<section class="home-section">
    <div class="home-wrap max-w-2xl text-center">
        <h2 class="home-display text-3xl sm:text-4xl lg:text-5xl">Try the demo. Install free. Launch if you want us to ship.</h2>
        <p class="home-lead mt-5">
            Click through the live product, install MIT with Composer, or book Electrik Launch when you want a shipped shell in 14 days.
        </p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
            <x-slate::button as="a" size="lg" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                Open demo
            </x-slate::button>
            <x-slate::button as="a" variant="outline" size="lg" href="{{ route('install') }}">
                Install free
            </x-slate::button>
            <x-slate::button as="a" variant="outline" size="lg" href="{{ route('launch') }}">
                Electrik Launch
            </x-slate::button>
        </div>
        <p class="mt-14 text-sm text-[var(--home-muted)]">
            Need a team to build on this stack?
            <a href="{{ route('contact') }}" class="text-[var(--home-ink)] underline underline-offset-4">{{ $studioName }}</a>
        </p>
    </div>
</section>
@endsection
