@props([
    'value',
    'note' => '',
])

@php
    $label = \App\Support\Compare::cellLabel($value);
    $tone = match ($value) {
        'yes' => 'text-foreground',
        'no' => 'text-muted-foreground',
        'partial' => 'text-foreground',
        default => 'text-muted-foreground',
    };
@endphp

<p class="font-medium {{ $tone }}">{{ $label }}</p>
@if ($note !== '')
    <p class="mt-1 text-xs leading-snug text-muted-foreground">{{ $note }}</p>
@endif
