@if ($item['type'] === 'section')
    <div class="{{ $loop->first ? 'mt-1' : 'mt-8' }} mb-1.5 px-2">
        <h3 class="text-xs font-medium text-muted-foreground">
            {{ $item['title'] }}
        </h3>
    </div>
    <ul class="flex flex-col gap-0.5">
        @foreach ($item['children'] as $child)
            @include('components.sidebar-item', ['item' => $child])
        @endforeach
    </ul>
@elseif ($item['type'] === 'file')
    @php
        $isActive = rtrim(request()->url(), '/') === rtrim($item['link'], '/');
    @endphp
    <li>
        <a
            href="{{ $item['link'] }}"
            @class([
                'block rounded-md px-2 py-1.5 text-sm transition-colors',
                'bg-muted font-medium text-foreground' => $isActive,
                'hover:bg-muted/60 hover:text-foreground' => ! $isActive,
            ])
        >
            {{ $item['title'] }}
        </a>
    </li>
@endif
