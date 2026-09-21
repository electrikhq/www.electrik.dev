@extends('layouts.www')

@php
    $seoTitle = 'License';
    $seoDescription = 'Electrik is MIT open source. Older BSL tags remain BSL for those releases. Paid Electrik Launch is delivery, not a kit license.';
    $seoUrl = siteCanonicalUrl('/license');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'License', 'url' => siteCanonicalUrl('/license')],
        ]),
    );
@endphp

@section('content')
<section class="site-page">
    <div class="prose-site">
        <h1>License</h1>
        <p>
            Electrik <strong>5.5.0+</strong> (current <code>5.x</code> default) is licensed under the
            <strong>MIT License</strong>. You may use it for personal or commercial projects without buying a kit license.
        </p>

        <h2>What changed</h2>
        <p>
            We dropped Business Source License and paid Solo/Studio kit licenses. The kit is open source.
            Money path is <a href="{{ route('launch') }}">Electrik Launch</a> — fixed-price delivery — not permission PDFs.
        </p>

        <h2>Older BSL releases</h2>
        <p>
            Published tags that shipped under Business Source License 1.1 (for example <code>v5.0.0</code>)
            remain BSL for those specific releases. Prefer <code>composer require electrik/electrik:^5.5</code>
            (or the latest 5.x) for MIT.
        </p>

        <h2>Slate and blocks</h2>
        <p>
            <strong>Electrik Slate</strong> (<code>electrik/slate</code>) and <strong>Slate Blocks</strong>
            (<code>electrik/slate-blocks</code>) were already MIT and stay MIT.
        </p>

        <h2>Full text</h2>
        <p>
            See the
            <a href="{{ config('site.github_url') }}/blob/5.x/LICENSE" target="_blank" rel="noopener noreferrer">LICENSE</a>
            file on GitHub.
        </p>
    </div>

    <div class="mt-10 flex flex-wrap gap-3">
        <x-slate::button as="a" href="{{ route('install') }}">Install</x-slate::button>
        <x-slate::button as="a" variant="outline" href="{{ route('launch') }}">Electrik Launch</x-slate::button>
    </div>
</section>
@endsection
