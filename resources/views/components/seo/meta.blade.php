@props([
    'title' => null,
    'description' => null,
    'url' => null,
    'image' => null,
    'type' => 'website',
    'robots' => null,
    'keywords' => null,
])

@php
    $meta = \App\Support\Seo::meta([
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'image' => $image,
        'type' => $type,
        'robots' => $robots,
        'keywords' => $keywords,
    ]);
@endphp

<title>{{ $meta['title'] }}</title>
<meta name="description" content="{{ $meta['description'] }}">
@if($meta['keywords'])
<meta name="keywords" content="{{ $meta['keywords'] }}">
@endif
<meta name="robots" content="{{ $meta['robots'] }}">
<meta name="author" content="Electrik">
<meta name="theme-color" content="#0a0a0a" media="(prefers-color-scheme: dark)">
<meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
<meta name="color-scheme" content="light dark">
<link rel="canonical" href="{{ $meta['url'] }}">

<meta property="og:site_name" content="{{ $meta['siteName'] }}">
<meta property="og:locale" content="{{ $meta['locale'] }}">
<meta property="og:type" content="{{ $meta['type'] }}">
<meta property="og:title" content="{{ $meta['title'] }}">
<meta property="og:description" content="{{ $meta['description'] }}">
<meta property="og:url" content="{{ $meta['url'] }}">
<meta property="og:image" content="{{ $meta['image'] }}">
<meta property="og:image:alt" content="{{ $meta['siteName'] }}">

<meta name="twitter:card" content="{{ $meta['twitterCard'] }}">
<meta name="twitter:site" content="{{ $meta['twitterSite'] }}">
<meta name="twitter:title" content="{{ $meta['title'] }}">
<meta name="twitter:description" content="{{ $meta['description'] }}">
<meta name="twitter:image" content="{{ $meta['image'] }}">

<link rel="icon" href="{{ asset('images/electrik-mark.svg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ asset('images/electrik-mark.png') }}">
