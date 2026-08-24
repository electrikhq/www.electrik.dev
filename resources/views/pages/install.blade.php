@extends('layouts.www')

@php
    $seoTitle = 'Install';
    $seoDescription = 'Install Electrik 5.x on Laravel 12: Composer require, electrik:install, Stripe sync, and demo seed.';
    $seoUrl = siteCanonicalUrl('/install');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Install', 'url' => siteCanonicalUrl('/install')],
        ]),
    );
@endphp

@section('content')
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
    <div class="prose-site">
        <h1>Install Electrik</h1>
        <p>
            Electrik ships as a Composer package. Your app keeps custom code in <code>App\</code>;
            product code lives under <code>Electrik\</code> in vendor.
        </p>

        <aside class="not-prose my-8 rounded-xl border border-border bg-muted/40 px-5 py-4 text-sm leading-relaxed">
            <p class="font-medium text-foreground">Already on Slate?</p>
            <p class="mt-1 text-muted-foreground">
                You’re halfway there. Electrik adds auth, teams, and Stripe billing on the same
                <code class="text-xs">&lt;x-slate::*&gt;</code> UI —
                <a class="underline underline-offset-2 hover:text-foreground" href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer">slate.electrik.dev</a>.
                Keep building components; wrap the product shell here.
            </p>
        </aside>

        <h2>Requirements</h2>
        <ul>
            <li>PHP 8.3+</li>
            <li>Laravel 12+</li>
            <li>Livewire 4</li>
            <li>Tailwind CSS v4</li>
            <li><code>electrik/slate</code> ^3.0@alpha</li>
            <li>Stripe account (test mode is fine for local dev)</li>
        </ul>

        <h2>Quickstart</h2>
        <pre><code class="language-bash">composer require electrik/electrik:^5.0@alpha
php artisan electrik:install
php artisan migrate
npm install && npm run build
php artisan serve</code></pre>

        <p>
            <code>electrik:install</code> publishes config, runs migrations, wires Slate CSS and <code>@@source</code>,
            registers routes, and syncs team permissions. Use <code>--migrate</code> on existing apps.
        </p>

        <h2>Stripe and plans</h2>
        <pre><code class="language-bash"># .env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...

php artisan electrik:stripe:sync</code></pre>

        <p>Then open <code>/billing</code> in your app to subscribe with Cashier on the team model.</p>

        <h2>Demo dataset</h2>
        <pre><code class="language-bash">php artisan storage:link
php artisan electrik:seed-demo</code></pre>

        <p>
            Creates <code>demo@@electrik.dev</code> / <code>password</code>, a sample team, roles, and marks onboarding complete.
            Try the hosted demo at
            <a href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">{{ config('site.demo_url') }}</a>.
        </p>

        <h2>UI customization</h2>
        <p>
            Components are <code>&lt;x-slate::*&gt;</code> from Electrik Slate.
            Docs, blocks, and themes live at
            <a href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer">slate.electrik.dev</a>.
            Do not copy Electrik views into your app unless you intend to override them.
        </p>

        <h2>Local lab checkout</h2>
        <p>
            Clone <a href="{{ config('site.github_url') }}" target="_blank" rel="noopener noreferrer">github.com/electrikhq/electrik</a>
            and use the sandbox reset script documented in the README for a path-repo workspace.
        </p>
    </div>

    <div class="mt-10 flex flex-wrap gap-3">
        <x-slate::button as="a" href="{{ config('site.github_url') }}" target="_blank" rel="noopener noreferrer">View on GitHub</x-slate::button>
        <x-slate::button as="a" variant="outline" href="{{ route('license') }}">Read the license</x-slate::button>
    </div>
</section>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
@endpush
@endsection
