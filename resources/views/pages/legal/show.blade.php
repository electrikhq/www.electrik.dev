@extends('layouts.www')

@php
    $seoTitle = $document['title'];
    $seoDescription = $document['description'] ?: 'Legal policy for electrik.dev.';
    $seoUrl = siteCanonicalUrl('/legal/'.$slug);
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Legal', 'url' => siteCanonicalUrl('/legal')],
            ['name' => $document['title'], 'url' => siteCanonicalUrl('/legal/'.$slug)],
        ]),
    );
@endphp

@section('content')
<section class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
    <div class="mx-auto grid max-w-4xl gap-10 lg:grid-cols-[12rem_minmax(0,1fr)]">
        <aside class="hidden lg:block">
            <p class="mb-3 text-xs font-medium uppercase tracking-wide text-muted-foreground">Legal</p>
            <nav class="space-y-1 text-sm">
                <a href="{{ route('legal.index') }}" class="block text-muted-foreground hover:text-foreground">All documents</a>
                @foreach ($siblings as $item)
                    <a
                        href="{{ $item['url'] }}"
                        @class([
                            'block hover:text-foreground',
                            'font-medium text-foreground' => $item['active'],
                            'text-muted-foreground' => ! $item['active'],
                        ])
                    >{{ $item['title'] }}</a>
                @endforeach
            </nav>
        </aside>

        <article>
            <p class="mb-4 text-sm">
                <a href="{{ route('legal.index') }}" class="text-muted-foreground hover:text-foreground">&larr; Legal</a>
            </p>

            @if ($document['updated'])
                <p class="mb-4 text-sm text-muted-foreground">Last updated {{ legalFormatUpdatedDate($document['updated']) }}</p>
            @endif

            <div class="prose-site legal-prose">
                {!! $document['html'] !!}
            </div>
        </article>
    </div>
</section>
@endsection
