<!DOCTYPE html>
<html lang="en" class="bg-white dark:bg-black h-screen">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(isset($title) && $title) {{ ucwords($title) }} - @endif
        @if(isset($project) && $project) {{ ucwords($project) }} - @endif
        @if(isset($version) && $version) {{ ucwords($version) }} - @endif
        {{ config('app.name', 'Electrik') }} - {{ config('app.tagline', 'Laravel SaaS Starter Kit') }}
    </title>

    <meta name="description" content="@if(isset($description) && $description){{ ($description ?? '') }}@endif">
    <meta property="og:title" content="@if(isset($title) && $title) {{ ucwords($title) }} - @endif
    @if(isset($project) && $project) {{ ucwords($project) }} - @endif
    @if(isset($version) && $version) {{ ucwords($version) }} - @endif
    {{ config('app.name', 'Electrik') }} - {{ config('app.tagline', 'Laravel SaaS Starter Kit') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:URL" content="{{ request()->url() }}" />
    <meta property="og:description" content="@if(isset($description) && $description){{ ($description ?? '') }}@endif" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

    @vite(['resources/css/application.css', 'resources/js/application.js'])

    @stack('styles')

    @yield('head')

    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/064d5bcdb0689bfbb9cb29316/6e30e55dcc6063c32531b4f95.js");</script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N8D7KL4F');</script>
    <!-- End Google Tag Manager -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4533175894495099"
    crossorigin="anonymous"></script>
</head>

<body class="min-h-screen h-full font-sans antialiased text-gray-900 dark:text-gray-100 bg-white dark:bg-black">

    <!-- Google Tag Manager (noscript) -->
    <!-- GTM-N8D7KL4F -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="flex flex-col h-screen" x-data="{ sidebarOpen: false }">

        <!-- Top Navbar -->
        <x-navbar />

        <div class="flex flex-1">
            @if(isset($sidebar))
            <!-- Sidebar (Desktop and Mobile) -->
            <aside class="flex-shrink-0 w-64 bg-white dark:bg-black "
                   :class="{'hidden md:flex': !sidebarOpen, 'fixed inset-0 z-50 flex': sidebarOpen}">
                <div class="flex flex-col w-full h-full">
                    <button @click="sidebarOpen = false" class="md:hidden text-gray-500 dark:text-gray-400">
                        <x-slate::icon icon="carbon-close" size="lg" />
                    </button>
                    @if(isset($availableVersions)) 
                        <div class="version-dropdown mb-4 text-xs px-4 pt-4">
                            <form x-data="{
                                version: '{{ $version }}',
                                updateAction() {
                                    const form = $el;
                                    const selectedVersion = this.version;
                                    form.action = form.action.replace(/\/{{ $version }}\//, '/' + selectedVersion + '/');
                                    form.submit();
                                }
                            }"
                                action="{{ route('docs.show', ['project' => $project, 'version' => $version, 'slug' => 'index']) }}"
                                method="get">
                                <label for="version" class="block text-xs font-medium text-gray-700">Version:</label>
                                <select id="version" name="version" x-model="version" @change="updateAction()" class="mt-1 block w-full pl-3 pr-10 py-2 text-xs border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-xs rounded-md">
                                    @foreach ($availableVersions as $ver)
                                    <option value="{{ $ver }}" {{ $version == $ver ? 'selected' : '' }}>
                                        {{ $ver }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    @endif
                    <nav class="flex-1 px-4 py-4 overflow-y-auto">
                        <ul class="space-y-2">
                            @foreach ($sidebar as $item)
                                @include('components.sidebar-item', ['item' => $item])
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </aside>
            @endif

            <!-- Main content -->
            <div class="flex-1 flex flex-col overflow-hidden ">
                <main class="flex-1 overflow-y-auto bg-white dark:bg-black">
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        @if(isset($slot))
                            {!! $slot !!}
                        @else
                            @yield('content')
                        @endif
                    </div>
                    <x-footer />
                </main>
            </div>
        </div>
    </div>
</body>
</html>