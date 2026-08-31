@props([
    'adSlot' => null,
])

@php
    $client = config('services.adsense.client');
    $resolvedSlot = $adSlot ?: config('services.adsense.docs_slot');
@endphp

@if (filled($client) && filled($resolvedSlot))
    {{--
        Standard AdSense square (250×250). Fits docs right rail (w-64).
        Prefer a fixed-size Display unit in AdSense; a responsive slot often still fills this box.
    --}}
    <div
        {{ $attributes->class('docs-adsense w-full max-w-[250px] rounded-xl border border-border bg-muted/40 p-2 shadow-xs') }}
        aria-label="Advertisement"
    >
        <p class="mb-1.5 px-0.5 text-[0.65rem] font-medium uppercase tracking-wide text-muted-foreground">
            Ad
        </p>
        <div class="mx-auto size-[250px] overflow-hidden rounded-lg bg-background/60">
            <ins
                class="adsbygoogle"
                style="display:inline-block;width:250px;height:250px"
                data-ad-client="{{ $client }}"
                data-ad-slot="{{ $resolvedSlot }}"
            ></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
@endif
