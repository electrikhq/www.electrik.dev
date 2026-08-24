@props([
    'href' => null,
    'title' => null,
    'tagline' => null,
    'thumbnail' => null,
])

@php
    $ph = config('product-hunt', []);
    $href = $href ?? ($ph['url'] ?? 'https://www.producthunt.com/products/electrik');
    $title = $title ?? ($ph['title'] ?? 'Electrik');
    $tagline = $tagline ?? ($ph['tagline'] ?? config('site.tagline'));
    $thumbnail = $thumbnail ?? ($ph['thumbnail'] ?? asset('images/electrik-mark.png'));
    if (is_string($thumbnail) && str_starts_with($thumbnail, '/')) {
        $thumbnail = asset(ltrim($thumbnail, '/'));
    }
@endphp

<a
    href="{{ $href }}"
    target="_blank"
    rel="noopener noreferrer"
    {{ $attributes->merge([
        'class' => 'group mx-auto flex w-full max-w-md items-center gap-3 rounded-xl border border-border bg-card p-3 text-start shadow-xs transition-colors hover:bg-accent/40',
    ]) }}
>
    <img
        src="{{ $thumbnail }}"
        alt=""
        width="56"
        height="56"
        class="size-14 shrink-0 rounded-lg object-cover"
        decoding="async"
    />
    <span class="min-w-0 flex-1">
        <span class="block truncate text-sm font-semibold text-foreground">{{ $title }}</span>
        <span class="mt-0.5 line-clamp-2 text-xs text-muted-foreground">{{ $tagline }}</span>
        <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-[#FF6154] group-hover:underline">
            Check it out on Product Hunt
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
            </svg>
        </span>
    </span>
</a>
