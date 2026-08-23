@extends('layouts.www')

@php
    $seoTitle = 'License';
    $seoDescription = 'Electrik uses Business Source License 1.1 with a free Additional Use Grant and a paid commercial lane for business use.';
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
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
    <div class="prose-site">
        <h1>License</h1>
        <p>
            Electrik is licensed under the <strong>Business Source License 1.1 (BSL 1.1)</strong>.
            You get the full feature set in source. What changes between lanes is <em>who may use it commercially</em>, not which features compile.
        </p>

        <h2>Additional Use Grant (free)</h2>
        <p>You may use Electrik without a commercial license when your use is limited to:</p>
        <ul>
            <li>Personal projects and learning</li>
            <li>Open-source projects</li>
            <li>Independent, pre-revenue experimentation by individuals or small informal teams</li>
        </ul>

        <h2>Commercial license required</h2>
        <p>The grant does <strong>not</strong> cover:</p>
        <ul>
            <li>Companies or other legal entities shipping a product</li>
            <li>Client, consulting, freelance, or agency work</li>
            <li>Internal business tools</li>
            <li>Any use as part of paid employment or professional services</li>
        </ul>
        <p>
            For those cases, contact
            <a href="mailto:{{ config('site.commercial_email') }}">{{ config('site.commercial_email') }}</a>
            for a commercial license.
        </p>

        <h2>Change date</h2>
        <p>
            Four years after first public release, Electrik relicenses to <strong>Apache License 2.0</strong>.
            See the full text in the
            <a href="{{ config('site.github_url') }}/blob/5.x/LICENSE" target="_blank" rel="noopener noreferrer">GitHub LICENSE file</a>.
        </p>

        <h2>Not MIT for every use case</h2>
        <p>
            Electrik is not "100% free for companies." That wording was wrong on older pages.
            Indie developers under the grant get the same codebase as commercial buyers; commercial buyers pay for permission, not a separate feature tier.
        </p>
    </div>

    <div class="mt-10 flex flex-wrap gap-3">
        <x-slate::button as="a" href="{{ route('pricing') }}">Commercial pricing</x-slate::button>
        <x-slate::button as="a" variant="outline" href="mailto:{{ config('site.commercial_email') }}">Contact for commercial use</x-slate::button>
    </div>
</section>
@endsection
