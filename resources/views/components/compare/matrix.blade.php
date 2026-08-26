@props([
    'electrik',
    'competitor' => null,
    'competitors' => null,
    'features',
    'mode' => 'pair', // pair | hub
])

@php
    $isHub = $mode === 'hub';
@endphp

<div class="overflow-x-auto border-t border-border">
    <table class="w-full min-w-[40rem] border-collapse text-left text-sm">
        <thead>
            <tr class="border-b border-border">
                <th scope="col" class="sticky left-0 z-10 bg-background py-3 pr-4 font-medium text-muted-foreground">Feature</th>
                <th scope="col" class="sticky left-[min(40%,12rem)] z-10 bg-background px-3 py-3 font-semibold text-foreground sm:static sm:left-auto">
                    Electrik
                </th>
                @if ($isHub)
                    @foreach ($competitors as $slug => $item)
                        <th scope="col" class="px-3 py-3 font-medium text-muted-foreground">
                            <a href="{{ route('compare.show', $slug) }}" class="hover:text-foreground hover:underline hover:underline-offset-4">
                                {{ $item['name'] }}
                            </a>
                        </th>
                    @endforeach
                @else
                    <th scope="col" class="px-3 py-3 font-semibold text-foreground">{{ $competitor['name'] }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($features as $key => $feature)
                <tr class="border-b border-border/80 align-top">
                    <th scope="row" class="sticky left-0 z-10 bg-background py-3 pr-4 font-medium text-foreground">
                        <span>{{ $feature['label'] }}</span>
                        <span class="mt-0.5 block text-xs font-normal text-muted-foreground">{{ $feature['description'] }}</span>
                    </th>
                    @php
                        $eCell = $electrik['cells'][$key] ?? ['value' => 'n/a', 'note' => ''];
                    @endphp
                    <td class="px-3 py-3">
                        <x-compare.cell :value="$eCell['value']" :note="$eCell['note'] ?? ''" />
                    </td>
                    @if ($isHub)
                        @foreach ($competitors as $slug => $item)
                            @php
                                $cell = $item['cells'][$key] ?? ['value' => 'n/a', 'note' => ''];
                            @endphp
                            <td class="px-3 py-3">
                                <x-compare.cell :value="$cell['value']" :note="$cell['note'] ?? ''" />
                            </td>
                        @endforeach
                    @else
                        @php
                            $cCell = $competitor['cells'][$key] ?? ['value' => 'n/a', 'note' => ''];
                        @endphp
                        <td class="px-3 py-3">
                            <x-compare.cell :value="$cCell['value']" :note="$cCell['note'] ?? ''" />
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
