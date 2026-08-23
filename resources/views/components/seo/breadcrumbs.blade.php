@props([
    'items' => [],
])

@if(count($items) > 0)
<nav class="mb-6 flex flex-wrap items-center gap-1.5 text-sm text-muted-foreground" aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-1.5">
        @foreach ($items as $index => $item)
            <li class="inline-flex items-center gap-1.5">
                @if($index > 0)
                    <svg class="size-3.5 shrink-0 opacity-50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                @endif
                @if($index < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="hover:text-foreground transition-colors">{{ $item['name'] }}</a>
                @else
                    <span class="text-foreground font-medium" aria-current="page">{{ $item['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
