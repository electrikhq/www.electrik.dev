@extends('layouts.www')

@php
    $tierId = request()->query('tier');
    $tier = collect(config('site.commercial_tiers'))->firstWhere('id', $tierId);
    $tierName = $tier['name'] ?? null;
    $paymentId = request()->query('payment_id');

    $seoTitle = 'Thanks for your purchase';
    $seoDescription = 'Electrik commercial license checkout complete. We will follow up with your license details.';
    $seoUrl = siteCanonicalUrl('/pricing/thanks');
    $seoRobots = 'noindex,follow';
@endphp

@section('content')
<section
    class="mx-auto max-w-2xl px-4 py-20 sm:px-6 text-center"
    @if ($paymentId)
        x-data="commerceThanks(@js($paymentId))"
        x-init="poll()"
    @endif
>
    <p class="font-mono text-xs tracking-[0.18em] text-muted-foreground uppercase">Checkout</p>
    <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">
        @if ($tierName)
            Thanks — {{ $tierName }} is almost yours
        @else
            Thanks for purchasing Electrik
        @endif
    </h1>
    <p class="mt-4 text-muted-foreground text-pretty">
        Payment confirmed by Dodo. We’ll email your commercial license details to the address used at checkout.
        Questions?
        <a class="text-foreground underline underline-offset-4" href="mailto:{{ config('site.commercial_email') }}">{{ config('site.commercial_email') }}</a>
    </p>

    @if ($paymentId)
        <div class="mt-6 rounded-xl border border-border bg-muted/20 px-4 py-3 text-sm text-left" aria-live="polite">
            <p class="font-medium text-foreground">Fulfillment status</p>
            <p class="mt-1 text-muted-foreground" x-text="message">Confirming with our license ledger…</p>
            <p class="mt-2 font-mono text-xs text-muted-foreground">Payment <span x-text="paymentId"></span></p>
        </div>
    @endif

    <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <x-slate::button as="a" href="{{ route('install') }}">Install guide</x-slate::button>
        <x-slate::button as="a" variant="outline" href="{{ route('docs.show', ['slug' => 'getting-started/installation']) }}">Docs</x-slate::button>
        <x-slate::button as="a" variant="ghost" href="{{ route('pricing') }}">Back to pricing</x-slate::button>
    </div>
</section>

@if ($paymentId)
    @push('scripts')
        <script>
            function commerceThanks(paymentId) {
                return {
                    paymentId,
                    message: 'Confirming with our license ledger…',
                    attempts: 0,
                    async poll() {
                        const max = 12;
                        while (this.attempts < max) {
                            this.attempts += 1;
                            try {
                                const res = await fetch('/api/commerce/status?payment_id=' + encodeURIComponent(this.paymentId));
                                const data = await res.json();
                                if (data.found) {
                                    if (data.revoked) {
                                        this.message = 'This purchase was refunded or revoked. Contact hello@electrik.dev if that looks wrong.';
                                        return;
                                    }
                                    if (data.has_license || data.fulfilled) {
                                        this.message = 'License recorded — check your inbox for confirmation (and spam folder). No activation key needed.';
                                        return;
                                    }
                                    if (data.status === 'succeeded') {
                                        this.message = 'Payment recorded. Sending license confirmation…';
                                    } else if (data.status === 'failed') {
                                        this.message = 'Payment did not complete. You can retry from Pricing.';
                                        return;
                                    } else {
                                        this.message = 'Status: ' + data.status + '. Still syncing…';
                                    }
                                } else {
                                    this.message = 'Waiting for payment webhook…';
                                }
                            } catch (e) {
                                this.message = 'Could not reach license status yet — confirmation email will still arrive if payment succeeded.';
                            }
                            await new Promise((r) => setTimeout(r, 2500));
                        }
                        this.message = 'Still processing. If you do not get an email within an hour, write hello@electrik.dev with this payment id.';
                    },
                };
            }
        </script>
    @endpush
@endif
@endsection
