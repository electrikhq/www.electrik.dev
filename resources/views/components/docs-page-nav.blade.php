@props([
    'previousPage' => null,
    'nextPage' => null,
])

@if ($previousPage || $nextPage)
    <nav
        {{ $attributes->merge(['class' => 'not-prose mt-12 flex w-full items-center justify-between gap-4']) }}
        aria-label="Documentation pages"
    >
        @if ($previousPage)
            <x-slate::button
                as="a"
                href="{{ $previousPage['link'] }}"
                variant="secondary"
                class="h-auto max-w-[calc(50%-0.5rem)] px-4 py-2 font-normal shadow-none"
            >
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                <span class="truncate">{{ $previousPage['title'] }}</span>
            </x-slate::button>
        @else
            <span aria-hidden="true"></span>
        @endif

        @if ($nextPage)
            <x-slate::button
                as="a"
                href="{{ $nextPage['link'] }}"
                variant="secondary"
                class="ms-auto h-auto max-w-[calc(50%-0.5rem)] px-4 py-2 font-normal shadow-none"
            >
                <span class="truncate">{{ $nextPage['title'] }}</span>
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </x-slate::button>
        @endif
    </nav>
@endif
