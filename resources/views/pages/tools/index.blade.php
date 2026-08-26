@extends('layouts.www')

@php
    $seoTitle = 'Free developer tools';
    $seoDescription = 'Free tools for Laravel and Tailwind builders — starting with a Tailwind CSS color palette generator that exports v4 @theme, v3 config, and Slate tokens.';
    $seoUrl = siteCanonicalUrl('/tools');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Tools', 'url' => siteCanonicalUrl('/tools')],
        ]),
    );

    $tools = [
        [
            'title' => 'Tailwind color generator',
            'description' => 'Create Tailwind shade scales, harmony schemes, and export v4 @theme CSS, v3 config, or Electrik Slate tokens.',
            'href' => route('tools.tailwind-color-generator'),
            'meta' => 'Colors · Free',
        ],
    ];
@endphp

@section('content')
<section class="px-4 pb-20 pt-14 sm:px-6 sm:pt-20">
    <div class="mx-auto max-w-3xl">
        <p class="font-mono text-xs tracking-[0.18em] text-muted-foreground uppercase">Free tools</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Tools for Laravel builders</h1>
        <p class="mt-4 text-lg text-muted-foreground text-pretty">
            Practical utilities we use while shipping Electrik and Slate — no account required.
        </p>
    </div>

    <div class="mx-auto mt-12 grid max-w-[1400px] gap-4 sm:grid-cols-2">
        @foreach ($tools as $tool)
            <a
                href="{{ $tool['href'] }}"
                class="group block border-t-2 border-border pt-6 transition hover:border-foreground"
            >
                <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">{{ $tool['meta'] }}</p>
                <h2 class="mt-2 text-xl font-semibold tracking-tight group-hover:underline group-hover:underline-offset-4">{{ $tool['title'] }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $tool['description'] }}</p>
            </a>
        @endforeach
    </div>
</section>
@endsection
