<!DOCTYPE html>
<html lang="en" class="h-full bg-background">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pageTitle = $seoTitle ?? null;
        $pageDescription = $seoDescription ?? null;
        $pageUrl = $seoUrl ?? siteCanonicalUrl(request()->getPathInfo());
        $pageGraph = $seoGraph ?? \App\Support\Seo::graph(
            \App\Support\Seo::organizationGraph(),
            \App\Support\Seo::websiteGraph(),
            \App\Support\Seo::softwareApplicationGraph(),
            \App\Support\Seo::productHuntReviewGraph(),
            \App\Support\Seo::breadcrumbGraph([
                ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ]),
        );
    @endphp

    <x-seo.meta
        :title="$pageTitle"
        :description="$pageDescription"
        :url="$pageUrl"
        type="website"
        :keywords="$seoKeywords ?? ['Laravel', 'SaaS', 'Livewire', 'Stripe', 'teams', 'billing', 'Electrik', 'Slate']"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Geist+Mono:wght@100..900&display=swap">

    <x-theme-init />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-seo.json-ld :graph="$pageGraph" />
    <x-analytics.gtag />

    @stack('styles')
    @yield('head')
</head>

<body class="min-h-full font-sans antialiased text-foreground bg-background">

    <div class="flex min-h-screen flex-col" x-data="{ sidebarOpen: false }">
        <x-site-navbar />

        <main class="flex-1">
            @yield('content')
            <x-site-footer />
        </main>
    </div>

    @stack('scripts')
</body>
</html>
