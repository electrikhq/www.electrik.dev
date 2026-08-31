@props([])

@php
    $client = config('services.adsense.client');
@endphp

@if (filled($client))
    <script
        async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $client }}"
        crossorigin="anonymous"
    ></script>
@endif
