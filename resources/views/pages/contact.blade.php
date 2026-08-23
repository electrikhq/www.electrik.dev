@extends('layouts.www')

@php
    $studio = config('site.studio');
    $seoTitle = 'Contact';
    $seoDescription = 'Have a Laravel or SaaS project? Get in touch with Quick Brown Fox, the studio behind Electrik and Slate.';
    $seoUrl = siteCanonicalUrl('/contact');
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Contact', 'url' => siteCanonicalUrl('/contact')],
        ]),
    );
@endphp

@section('content')
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
    <div class="prose-site">
        <h1>Have a project? Get in touch</h1>
        <p>
            Electrik and Slate are built by
            <a href="{{ $studio['url'] }}" target="_blank" rel="noopener noreferrer">{{ $studio['name'] }}</a>,
            a Laravel-focused product studio. If you need a team to design, build, or ship a SaaS product
            (with Electrik or on a custom Laravel stack), tell us what you are building.
        </p>

        <h2>Good fits</h2>
        <ul>
            <li>New SaaS products that need auth, teams, and billing done right</li>
            <li>Existing Laravel apps that need a modern Livewire / Blade UI pass</li>
            <li>Commercial Electrik licenses plus implementation help</li>
            <li>Agencies or founders who want a trusted Laravel delivery partner</li>
        </ul>

        <h2>How to reach us</h2>
        <p>
            Email
            <a href="mailto:{{ $studio['email'] }}?subject=Project%20inquiry">{{ $studio['email'] }}</a>
            with a short note: what you are building, timeline, and whether you already use Laravel.
            We will reply if it looks like a mutual fit.
        </p>
    </div>

    <div class="mt-10 flex flex-wrap gap-3">
        <x-slate::button as="a" href="mailto:{{ $studio['email'] }}?subject=Project%20inquiry">
            Email {{ $studio['name'] }}
        </x-slate::button>
        <x-slate::button as="a" variant="outline" href="{{ $studio['url'] }}" target="_blank" rel="noopener noreferrer">
            Studio site
        </x-slate::button>
        <x-slate::button as="a" variant="outline" href="mailto:{{ config('site.commercial_email') }}?subject=Electrik%20commercial%20license">
            Commercial license only
        </x-slate::button>
    </div>
</section>
@endsection
