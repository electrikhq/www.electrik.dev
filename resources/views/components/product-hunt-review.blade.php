@php
    $ph = config('product-hunt', []);
    $review = $ph['review'] ?? [];
    $reviewsUrl = $ph['reviews_url'] ?? ($ph['url'] ?? '#');
    $rating = $ph['rating'] ?? '5.0';
    $count = $ph['review_count'] ?? 1;
@endphp

@if ($review !== [])
<section {{ $attributes->merge(['class' => 'border-t border-border px-4 py-16 sm:px-6']) }}>
    <div class="mx-auto max-w-3xl">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Product Hunt</p>
                <h2 class="mt-2 text-2xl font-semibold tracking-tight text-foreground">
                    {{ $rating }} · {{ $count }} {{ $count === 1 ? 'review' : 'reviews' }}
                </h2>
            </div>
            <a
                href="{{ $reviewsUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="text-sm font-medium text-[#FF6154] underline-offset-4 hover:underline"
            >
                Read on Product Hunt →
            </a>
        </div>

        <article class="mt-8 rounded-xl border border-border bg-card p-6 shadow-xs sm:p-8">
            <div class="flex flex-wrap items-center gap-2 text-sm">
                <span class="font-medium text-foreground">{{ $review['author'] ?? 'Founder' }}</span>
                @if (! empty($review['role']))
                    <span class="text-muted-foreground">· {{ $review['role'] }} review</span>
                @endif
            </div>

            @if (! empty($review['great']))
                <p class="mt-5 text-xs font-medium uppercase tracking-wider text-muted-foreground">What's great</p>
                <ul class="mt-2 flex flex-wrap gap-2">
                    @foreach ($review['great'] as $item)
                        <li class="rounded-md bg-muted px-2.5 py-1 text-xs text-foreground">{{ $item }}</li>
                    @endforeach
                </ul>
            @endif

            @if (! empty($review['body']))
                <p class="mt-5 text-[15px] leading-relaxed text-foreground">{{ $review['body'] }}</p>
            @endif

            @if (! empty($review['improve']))
                <p class="mt-5 text-xs font-medium uppercase tracking-wider text-muted-foreground">What needs improvement</p>
                <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $review['improve'] }}</p>
            @endif

            @if (! empty($review['vs']))
                <p class="mt-5 text-xs font-medium uppercase tracking-wider text-muted-foreground">vs Alternatives</p>
                <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $review['vs'] }}</p>
            @endif
        </article>
    </div>
</section>
@endif
