@extends('layouts.www')

@section('content')

<section class="bg-white dark:bg-black flex flex-col">
    <!-- Announcement Banner -->
    <div class="my-12 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        
        <!-- Hero Section -->
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
            Your Next Big SaaS Starts Here
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 dark:text-gray-400 lg:text-xl sm:px-16 xl:px-48">
            Electrik is a free and open-source Laravel starter-kit that gives you everything you need to start building a SaaS product.
        </p>
        <div class="mt-4">
            <img src="{{ Vite::asset('resources/images/electrik-dashboard.png') }}" alt="Electrik Dashboard" class="w-3/4 h-auto text-center mx-auto" />
        </div>
        <div class="mt-12 flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <x-slate::button size="lg" color="black" href="{{ url('docs') }}">Documentation</x-slate::button>
            <x-slate::button size="lg" color="black" icon="carbon-logo-github" link="https://github.com/electrikhq/electrik">Github</x-slate::button>
        </div>
        <hr/>
            <x-newsletter />
        <hr/>
    </div>
</section>

<section class="bg-neutral-100 dark:bg-black flex flex-col py-24">
    <!-- Introduction Section -->
    <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36 prose-lg font-serif text-black dark:text-white">
        <h2>Why Another Laravel Starter Kit?</h2>
        <p>It's true that there are a lot of Laravel SaaS starter kits available on the Internet and they are bloody good too. What breaks my heart is that almost every of these SaaS starter kits has two versions, one free, and one paid. These kits in their free versions, provide the bare minimum features. Some would lock billing as a paid feature and others would block team management as a paid feature. In my view, this is exactly what OSS philosophy is not. I am not at all saying that they should not charge for their creations. What I am saying is that there should be an open-source, 100% free, and full-featured alternative also available for people to choose from. My intention is just that.</p>
        <p>Electrik provides all the core features that are required for any SaaS. For example, it supports recurring billing via cashier, multiple teams, User configurable roles and permissions, and much much more.</p>
        <p>- Neeraj Kumar</p>
    </div>
</section>

<section class="bg-white dark:bg-black flex flex-col">
    <!-- Features Section 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4 items-center py-24">
        <div class="p-0 md:p-12 text-black dark:text-white">
            <h2 class="uppercase font-medium">Work with Tools You Already Use</h2>
            <p class="mt-4 text-lg">Electrik is built on top of popular tools like Laravel, Livewire, TailwindCSS, Alpine.js, and Slate, accelerating critical development time.</p>
            <ul class="mt-4 list-disc list-inside space-y-1">
                <li>Laravel</li>
                <li>Livewire</li>
                <li>TailwindCSS</li>
                <li>Electrik/Slate</li>
                <li>Spatie Permissions</li>
                <li>And more...</li>
            </ul>
            <p class="mt-4">Electrik is the perfect, battle-tested SaaS starter kit for your next big idea.</p>
            <x-slate::button class="mt-4" icon="carbon-arrow-right" icon-position="after" href="https://docs.electrik.dev" target="_blank">Documentation</x-slate::button>
        </div>
        <div class="col-span-1">
            <img src="{{ Vite::asset('resources/images/electrik-dashboard.png') }}" alt="Electrik Dashboard" class="w-full h-auto rounded-md shadow-md" />
        </div>
    </div>
</section>

<section class="bg-white dark:bg-black flex flex-col">
    <!-- Features Section 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4 items-center py-24">
        <div class="col-span-1">
            <img src="{{ Vite::asset('resources/images/electrik-onboarding.png') }}" alt="Electrik Onboarding" class="w-full h-auto rounded-md shadow-md" />
        </div>
        <div class="p-12 text-black dark:text-white">
            <h2 class="uppercase font-medium">All the Features in One Library</h2>
            <p class="mt-4 text-lg">We believe open-source projects should be truly open-source, with no features locked behind a paywall. Electrik provides all the essential features required to build your next big SaaS.</p>
            <ul class="mt-4 list-disc list-inside space-y-1">
                <li>Subscription billing management (via Stripe)</li>
                <li>Team management</li>
                <li>Roles and permissions</li>
                <li>Zero-config installation (well, almost!)</li>
                <li>In-built support for dark mode</li>
                <li>Notifications, toasts, alerts, modals, and much more.</li>
            </ul>
            <p class="mt-4">To see the full list of available features, please check out the documentation.</p>
            <x-slate::button class="mt-4" icon="carbon-arrow-right" icon-position="after" href="https://docs.electrik.dev" target="_blank">Documentation</x-slate::button>
        </div>
    </div>
</section>

<section class="bg-white dark:bg-black flex flex-col">
    <!-- Pricing Section -->
    <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36 prose-lg font-serif text-black dark:text-white py-6">
        <h2>Designed by Developers for Developers Like You!</h2>
        <p>We believe that open-source projects should not be paywalled to access additional features. We believe in the true spirit of open source. Our pricing will surprise you!</p>
        <h2>Pricing</h2>
        <p class="text-7xl">$0</p>
        <p>Best for every kind of team, whether big or small.</p>
    </div>
</section>

<section class="bg-gray-100 dark:bg-gray-900 py-8">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Frequently Asked Questions</h2>
        <div class="mt-6 space-y-4">
            <div class="text-left">
                <button class="w-full text-left text-gray-800 dark:text-gray-200 font-medium">
                    What is Electrik Laravel SaaS Starter Kit?
                </button>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Electrik is a free and open-source Laravel starter kit that provides all the essential tools you need to start building a SaaS product. It is built on top of popular frameworks and libraries such as Laravel, Livewire, TailwindCSS, and Alpine.js, allowing you to accelerate critical development time.
                </p>
            </div>
            <div class="text-left">
                <button class="w-full text-left text-gray-800 dark:text-gray-200 font-medium">
                    Who is Electrik designed for?
                </button>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Electrik is designed for developers who want to quickly start building SaaS applications. Whether you are working on a small project or a large-scale enterprise application, Electrik provides a solid foundation to get you started.
                </p>
            </div>
            <div class="text-left">
                <button class="w-full text-left text-gray-800 dark:text-gray-200 font-medium">
                    How do I install Electrik?
                </button>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    To install Electrik, clone the GitHub repository and follow the setup instructions provided in the documentation.
                </p>
            </div>
            <!-- Add more FAQs here -->
        </div>
        <div class="mt-4">
            <x-slate::button href="{{ url('/faqs') }}" color="white" icon="carbon-arrow-right" icon-position="after">View All FAQs</x-slate::button>
        </div>
    </div>
</section>


@endsection
