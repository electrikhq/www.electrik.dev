@extends('layouts.www')

@php
    use App\Support\Resources;

    /** @var array<string, mixed> $page */
    $slug = $page['slug'];
    $seoTitle = $page['title'];
    $seoDescription = $page['description'];
    $seoUrl = Resources::urlFor($slug);
    $seoKeywords = $page['keywords'] ?? [];
    $faqs = $page['faqs'] ?? [];

    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Resources', 'url' => siteCanonicalUrl('/resources')],
            ['name' => $page['nav_title'], 'url' => $seoUrl],
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
                ],
            ],
        ],
        \App\Support\Seo::techArticleGraph(
            $seoTitle,
            $seoDescription,
            $seoUrl,
            now(),
            'Resources',
        ),
    );
@endphp

@section('content')
<section class="home-dot-canvas border-b border-[var(--home-line)] px-4 pb-14 pt-16 sm:px-6 sm:pb-16 sm:pt-20">
    <div class="mx-auto max-w-3xl">
        <p class="home-eyebrow">
            <a href="{{ route('resources.index') }}" class="hover:text-[var(--home-ink)]">Resources</a>
            <span class="mx-2 opacity-40">/</span>
            {{ $page['eyebrow'] }}
        </p>
        <h1 class="site-page-title mt-5 text-pretty">{{ $page['nav_title'] }}</h1>
        <p class="site-page-lead">{{ $page['lede'] }}</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a
                href="{{ route('pricing') }}"
                class="inline-flex items-center justify-center rounded-md bg-foreground px-4 py-2.5 text-sm font-medium text-background transition hover:opacity-90"
            >View pricing</a>
            <a
                href="{{ config('site.demo_url') }}"
                class="inline-flex items-center justify-center rounded-md border border-border px-4 py-2.5 text-sm font-medium text-foreground transition hover:bg-muted"
                target="_blank"
                rel="noopener noreferrer"
            >Open demo</a>
            <a
                href="{{ route('install') }}"
                class="inline-flex items-center justify-center px-2 py-2.5 text-sm font-medium text-muted-foreground underline underline-offset-4 hover:text-foreground"
            >Install guide</a>
        </div>
    </div>
</section>

@foreach ($page['sections'] as $section)
    <section class="border-b border-border px-4 py-12 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <h2 class="text-2xl font-semibold tracking-tight">{{ $section['heading'] }}</h2>
            @foreach ($section['body'] ?? [] as $paragraph)
                <p class="mt-4 text-base leading-relaxed text-muted-foreground">{{ $paragraph }}</p>
            @endforeach
            @if (! empty($section['bullets']))
                <ul class="mt-6 list-disc space-y-2 ps-5 text-base leading-relaxed text-muted-foreground">
                    @foreach ($section['bullets'] as $bullet)
                        <li>{{ $bullet }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endforeach

@if (count($faqs) > 0)
    <section class="border-b border-border px-4 py-12 sm:px-6">
        <div class="mx-auto max-w-3xl">
            <h2 class="text-2xl font-semibold tracking-tight">FAQ</h2>
            <dl class="mt-8 space-y-8">
                @foreach ($faqs as $faq)
                    <div class="border-t border-border pt-6">
                        <dt class="text-base font-medium text-foreground">{{ $faq['question'] }}</dt>
                        <dd class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $faq['answer'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>
@endif

<section class="border-b border-border px-4 py-12 sm:px-6">
    <div class="mx-auto max-w-3xl">
        <h2 class="text-2xl font-semibold tracking-tight">Related</h2>
        <ul class="mt-6 space-y-3 text-sm">
            @foreach ($page['related'] as $item)
                @php
                    $href = $item['href'] ?? route('resources.show', $item['slug']);
                @endphp
                <li>
                    <a href="{{ $href }}" class="font-medium text-foreground underline underline-offset-4 hover:opacity-80">{{ $item['label'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-3xl">
        <h2 class="text-2xl font-semibold tracking-tight">Try Electrik</h2>
        <p class="mt-3 text-base text-muted-foreground text-pretty">
            Composer package for Laravel SaaS: teams, Stripe on the team, Slate UI. MIT (5.5+) — free to ship. Paid path: Electrik Launch.
        </p>
        <div class="mt-6 flex flex-wrap gap-3">
            <a
                href="{{ route('pricing') }}"
                class="inline-flex items-center justify-center rounded-md bg-foreground px-4 py-2.5 text-sm font-medium text-background transition hover:opacity-90"
            >Pricing</a>
            <a
                href="{{ config('site.demo_url') }}"
                class="inline-flex items-center justify-center rounded-md border border-border px-4 py-2.5 text-sm font-medium transition hover:bg-muted"
                target="_blank"
                rel="noopener noreferrer"
            >Demo</a>
        </div>
    </div>
</section>
@endsection
