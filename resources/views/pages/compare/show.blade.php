@extends('layouts.www')

@php
    use App\Support\Compare;

    /** @var array<string, mixed> $competitor */
    $slug = $competitor['slug'];
    $name = $competitor['name'];
    $electrik = Compare::electrik();
    $features = Compare::featureRows();
    $related = Compare::related($slug);
    $faqs = Compare::faqsFor($competitor);

    $seoTitle = 'Electrik vs '.$name.' — '.$name.' alternative';
    $seoDescription = 'Electrik as a '.$name.' alternative: feature matrix, licensing, billing, UI, and when to choose Electrik vs '.$name.'.';
    $seoUrl = Compare::urlFor($slug);
    $seoKeywords = [
        strtolower($name).' alternative',
        $slug.' alternative',
        'best '.$slug.' alternative',
        'electrik vs '.strtolower($name),
        'electrik vs '.$slug,
        'laravel saas starter alternative',
        'laravel saas starter comparison',
        'electrik '.$slug,
    ];

    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Compare', 'url' => siteCanonicalUrl('/compare')],
            ['name' => 'Electrik vs '.$name, 'url' => $seoUrl],
        ]),
        \App\Support\Seo::faqPageGraph($seoUrl, $faqs),
        [
            [
                '@type' => 'WebPage',
                '@id' => $seoUrl.'#webpage',
                'url' => $seoUrl,
                'name' => $seoTitle,
                'description' => $seoDescription,
                'isPartOf' => ['@id' => siteCanonicalUrl('/').'#website'],
                'about' => [
                    ['@type' => 'SoftwareApplication', 'name' => 'Electrik'],
                    ['@type' => 'SoftwareApplication', 'name' => $name],
                ],
            ],
        ],
    );
@endphp

@section('content')
<section class="relative overflow-hidden border-b border-border px-4 pb-12 pt-14 sm:px-6 sm:pt-18">
    <div
        class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_70%_50%_at_80%_-10%,color-mix(in_oklch,var(--slate-foreground)_7%,transparent),transparent)]"
        aria-hidden="true"
    ></div>
    <div class="mx-auto max-w-3xl">
        <p class="font-mono text-xs tracking-[0.18em] text-muted-foreground uppercase">
            <a href="{{ route('compare.index') }}" class="hover:text-foreground">Compare</a>
            <span class="mx-2 text-border">/</span>
            Alternatives
        </p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Electrik vs {{ $name }}</h1>
        <p class="mt-3 text-base font-medium text-foreground">
            A {{ $name }} alternative for Laravel SaaS teams that want package-first auth, teams, and Stripe.
        </p>
        <p class="mt-3 text-lg text-muted-foreground text-pretty">
            {{ $competitor['summary'] }}
        </p>
        <div class="mt-6 flex flex-wrap gap-3 text-sm text-muted-foreground">
            <a
                href="{{ $competitor['url'] }}"
                class="underline underline-offset-4 hover:text-foreground"
                target="_blank"
                rel="noopener noreferrer"
            >{{ $name }} site</a>
            <span class="text-border" aria-hidden="true">·</span>
            <a href="{{ route('install') }}" class="underline underline-offset-4 hover:text-foreground">Install Electrik</a>
            <span class="text-border" aria-hidden="true">·</span>
            <a href="{{ config('site.demo_url') }}" class="underline underline-offset-4 hover:text-foreground" target="_blank" rel="noopener noreferrer">Demo</a>
        </div>
    </div>
</section>

<section class="border-b border-border px-4 py-12 sm:px-6">
    <div class="mx-auto max-w-3xl">
        <h2 class="text-2xl font-semibold tracking-tight">The short version</h2>
        <p class="mt-4 text-base leading-relaxed text-muted-foreground">{{ $competitor['verdict'] }}</p>
        <dl class="mt-8 grid gap-6 sm:grid-cols-2">
            <div class="border-t border-border pt-4">
                <dt class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Stack notes</dt>
                <dd class="mt-2 text-sm leading-relaxed text-foreground">{{ $competitor['stack_notes'] }}</dd>
            </div>
            <div class="border-t border-border pt-4">
                <dt class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Pricing posture</dt>
                <dd class="mt-2 text-sm leading-relaxed text-foreground">{{ $competitor['pricing_blurb'] }}</dd>
            </div>
        </dl>
    </div>
</section>

<section class="px-4 py-14 sm:px-6">
    <div class="mx-auto max-w-[1400px]">
        <div class="mb-8 max-w-3xl">
            <h2 class="text-2xl font-semibold tracking-tight">Feature matrix</h2>
            <p class="mt-2 text-sm text-muted-foreground">{{ $competitor['intro'] }}</p>
            <p class="mt-2 text-xs text-muted-foreground">{{ Compare::disclaimer() }}</p>
        </div>
        <x-compare.matrix
            mode="pair"
            :electrik="$electrik"
            :competitor="$competitor"
            :features="$features"
        />
    </div>
</section>

<section class="border-t border-border px-4 py-14 sm:px-6">
    <div class="mx-auto max-w-3xl space-y-12">
        <h2 class="text-2xl font-semibold tracking-tight">Deeper comparison</h2>
        @foreach ($competitor['sections'] as $section)
            <div>
                <h3 class="text-lg font-semibold tracking-tight">{{ $section['title'] }}</h3>
                <p class="mt-3 text-base leading-relaxed text-muted-foreground">{{ $section['body'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="border-t border-border px-4 py-14 sm:px-6">
    <div class="mx-auto grid max-w-5xl gap-10 md:grid-cols-2">
        <div>
            <h2 class="text-xl font-semibold tracking-tight">Choose Electrik if</h2>
            <ul class="mt-5 space-y-3 text-sm leading-relaxed text-muted-foreground">
                @foreach ($competitor['when_electrik'] as $item)
                    <li class="border-t border-border pt-3 text-foreground">{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <h2 class="text-xl font-semibold tracking-tight">Choose {{ $name }} if</h2>
            <ul class="mt-5 space-y-3 text-sm leading-relaxed text-muted-foreground">
                @foreach ($competitor['when_them'] as $item)
                    <li class="border-t border-border pt-3 text-foreground">{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

@if (! empty($competitor['caveats']))
    <section class="border-t border-border px-4 py-12 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <h2 class="text-xl font-semibold tracking-tight">Caveats</h2>
            <ul class="mt-5 space-y-2 text-sm leading-relaxed text-muted-foreground">
                @foreach ($competitor['caveats'] as $caveat)
                    <li>{{ $caveat }}</li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

@if ($faqs !== [])
    <section class="border-t border-border px-4 py-14 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <h2 class="text-2xl font-semibold tracking-tight">Electrik vs {{ $name }} FAQ</h2>
            <div class="mt-8 space-y-6">
                @foreach ($faqs as $faq)
                    <div>
                        <h3 class="text-base font-medium">{{ $faq['question'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $faq['answer'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="border-t border-border bg-muted/30 px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-2xl font-semibold tracking-tight">Try Electrik next</h2>
        <p class="mt-3 text-muted-foreground">
            Composer install, or click the demo — then read
            <a href="{{ route('pricing') }}" class="underline underline-offset-4 hover:text-foreground">pricing</a>
            if you are past the grant.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <x-slate::button as="a" href="{{ route('install') }}">Install guide</x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                Live demo
            </x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ route('compare.index') }}">All comparisons</x-slate::button>
        </div>
    </div>
</section>

@if ($related !== [])
    <section class="border-t border-border px-4 py-12 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <h2 class="text-lg font-semibold tracking-tight">Related comparisons</h2>
            <ul class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm">
                @foreach ($related as $item)
                    <li>
                        <a href="{{ $item['href'] }}" class="underline underline-offset-4 hover:text-foreground">
                            Electrik vs {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
@endsection
