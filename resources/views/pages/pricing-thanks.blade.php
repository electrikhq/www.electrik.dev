@extends('layouts.www')

@php
    $tierId = request()->query('tier');
    $tier = collect(config('site.commercial_tiers'))->firstWhere('id', $tierId);
    $tierName = $tier['name'] ?? null;

    $seoTitle = 'Thanks for your purchase';
    $seoDescription = 'Electrik commercial license checkout complete. We will follow up with your license details.';
    $seoUrl = siteCanonicalUrl('/pricing/thanks');
    $seoRobots = 'noindex,follow';
@endphp

@section('content')
<section class="mx-auto max-w-2xl px-4 py-20 sm:px-6 text-center">
    <p class="font-mono text-xs tracking-[0.18em] text-muted-foreground uppercase">Checkout</p>
    <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">
        @if ($tierName)
            Thanks — {{ $tierName }} is almost yours
        @else
            Thanks for purchasing Electrik
        @endif
    </h1>
    <p class="mt-4 text-muted-foreground text-pretty">
        Stripe confirms payment. We’ll email your commercial license details to the address used at checkout,
        usually within one business day. Questions?
        <a class="text-foreground underline underline-offset-4" href="mailto:{{ config('site.commercial_email') }}">{{ config('site.commercial_email') }}</a>
    </p>
    <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <x-slate::button as="a" href="{{ route('install') }}">Install guide</x-slate::button>
        <x-slate::button as="a" variant="outline" href="{{ route('docs.show', ['slug' => 'getting-started/installation']) }}">Docs</x-slate::button>
        <x-slate::button as="a" variant="ghost" href="{{ route('pricing') }}">Back to pricing</x-slate::button>
    </div>
</section>
@endsection
