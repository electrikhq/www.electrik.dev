@props([
    'id' => null,
])

@php
    $measurementId = $id ?: config('services.google_analytics.measurement_id');
@endphp

@if(filled($measurementId))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $measurementId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json($measurementId));
    </script>
@endif
