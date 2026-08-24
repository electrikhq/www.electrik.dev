@extends('layouts.www')

@php
    $seoTitle = 'Legal';
    $seoDescription = 'Privacy, terms, cookies, trademark, and copyright policies for electrik.dev and the Electrik product.';
    $seoUrl = siteCanonicalUrl('/legal');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Legal', 'url' => siteCanonicalUrl('/legal')],
        ]),
    );
@endphp

@section('content')
<section class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-2xl text-center">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Legal documents and policies</h1>
        <p class="mt-3 text-muted-foreground">
            Policies for electrik.dev, the Electrik starter kit, and related community resources.
        </p>
    </div>

    <div class="mt-12 space-y-12">
        @foreach (legalHubSections() as $section)
            <div>
                <h2 class="text-xl font-semibold tracking-tight">{{ $section['title'] }}</h2>
                @if (! empty($section['description']))
                    <p class="mt-1 text-sm text-muted-foreground">{{ $section['description'] }}</p>
                @endif

                <ul class="mt-6 divide-y divide-border rounded-xl border border-border/80 bg-card">
                    @foreach ($section['documents'] as $document)
                        <li>
                            <a
                                href="{{ $document['url'] }}"
                                @if (! empty($document['external'])) target="_blank" rel="noopener noreferrer" @endif
                                class="flex flex-col gap-1 px-5 py-4 transition-colors hover:bg-muted/40 sm:flex-row sm:items-center sm:justify-between"
                            >
                                <span class="font-medium text-foreground">{{ $document['title'] }}</span>
                                @if (! empty($document['updated']))
                                    <span class="text-sm text-muted-foreground">Last updated {{ legalFormatUpdatedDate($document['updated']) }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <p class="mx-auto mt-12 max-w-2xl text-center text-sm text-muted-foreground">
        Questions about these policies?
        <a href="mailto:{{ config('legal.contact_email') }}" class="underline underline-offset-4 hover:text-foreground">{{ config('legal.contact_email') }}</a>.
    </p>
</section>
@endsection
