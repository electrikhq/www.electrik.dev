@extends('layouts.www')

@section('content')


<section class="bg-neutral-100 dark:bg-black flex flex-col py-24">

    <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36 prose-lg font-serif text-black dark:text-white">
        <h2>Welcome to the Docs</h2>
        <p>Welcome to the documentation hub for <strong>Electrik</strong> and <strong>Slate</strong>. This is where you'll find everything you need to get up and running with these awesome tools I've been working on.</p>
        <p>Use the sections below to explore the docs for <strong>Electrik</strong> and <strong>Slate</strong>. Whether you're setting up your first SaaS app with Electrik or styling your project with Slate, I've got you covered with step-by-step guides, code snippets, and practical examples.</p>
    </div>
</section>

<section class="bg-white dark:bg-black flex flex-col">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-4 py-24 max-w-screen-xl mx-auto">
        

        <div class="p-8 bg-neutral-50 dark:bg-neutral-800 rounded-lg shadow-md text-black dark:text-white">
            <h2 class="text-3xl font-bold mb-4">Electrik - Laravel & Livewire SaaS Boilerplate</h2>
            <p class="text-lg mb-4">Electrik is your all-in-one, free, open-source Laravel starter kit that's got everything you need to kickstart your next SaaS idea. No paywalls, no stripped-down free versions—just a full-featured, battle-tested kit that's ready to go.</p>
            <ul class="list-disc list-inside mb-4 space-y-2">
                <li>Built with Laravel & Livewire</li>
                <li>Authentication & User Management</li>
                <li>Subscription Management with Stripe</li>
                <li>Feature-rich Admin Dashboard</li>
                <li>Responsive Design</li>
                <li>Developer Friendly with Clean Code</li>
            </ul>
            <x-slate::button class="mt-4" icon="carbon-arrow-right" icon-position="after" href="https://docs.electrik.dev" target="_blank">Electrik Documentation</x-slate::button>
        </div>


        <div class="p-8 bg-neutral-50 dark:bg-neutral-800 rounded-lg shadow-md text-black dark:text-white">
            <h2 class="text-3xl font-bold mb-4">Slate - Laravel Blade UI Kit</h2>
            <p class="text-lg mb-4">Slate is a sleek and modern Laravel Blade UI kit that helps you quickly build beautiful and functional user interfaces. With a collection of pre-designed UI components, Slate makes it easy to enhance the look and feel of your web application.</p>
            <ul class="list-disc list-inside mb-4 space-y-2">
                <li>Pre-built Blade Components</li>
                <li>Tailwind CSS Integration</li>
                <li>Dark Mode Support</li>
                <li>Reusable Components for Efficiency</li>
                <li>Accessibility Ready</li>
                <li>Detailed Documentation</li>
            </ul>
            <x-slate::button class="mt-4" icon="carbon-arrow-right" icon-position="after" href="{{ url('docs/slate/1-x') }}" target="_blank">Slate Documentation</x-slate::button>
        </div>

    </div>
</section>

@endsection
