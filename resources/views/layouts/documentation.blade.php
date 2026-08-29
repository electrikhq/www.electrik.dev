<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <x-seo.meta
        :title="$title ?? 'Docs'"
        :description="$description ?? 'Electrik documentation'"
        :url="$pageUrl ?? null"
        type="article"
        :published="$lastModifiedDate ?? null"
        :modified="$lastModifiedDate ?? null"
        section="Documentation"
        :keywords="['Laravel', 'SaaS', 'Livewire', 'Stripe', 'teams', 'billing', 'Electrik', 'Slate']"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Geist+Mono:wght@100..900&display=swap">
    <x-theme-init />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-seo.json-ld :graph="$seoGraph ?? []" />
    @stack('head')
</head>

<body
    class="bg-background text-foreground antialiased"
    x-data="{
        sidebarOpen: false,
        activeHeading: '',
        init() {
            const headings = [...document.querySelectorAll('article.docs-prose h2, article.docs-prose h3, article.docs-prose h4')]
                .filter((el) => el.id);

            if (!headings.length) return;

            const setActive = () => {
                const offset = 120;
                let current = headings[0].id;
                for (const heading of headings) {
                    if (heading.getBoundingClientRect().top <= offset) {
                        current = heading.id;
                    }
                }
                this.activeHeading = current;
            };

            setActive();
            window.addEventListener('scroll', setActive, { passive: true });
        }
    }"
>
    <x-site-navbar :docs="true" :sections="$sidebar ?? []" />

    <div
        x-show="sidebarOpen"
        x-cloak
        x-on:click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/40 md:hidden"
    ></div>

    <div class="mx-auto flex w-full max-w-full">
        <aside
            class="fixed inset-y-0 left-0 z-50 w-72 shrink-0 overflow-y-auto border-r border-border bg-background pt-14 transition-transform md:sticky md:top-14 md:z-0 md:h-[calc(100vh-3.5rem)] md:translate-x-0 md:pt-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        >
            <nav class="px-4 py-6 md:px-6">
                @if(isset($sidebar))
                    @foreach ($sidebar as $item)
                        @include('components.sidebar-item', ['item' => $item])
                    @endforeach
                @endif
            </nav>
        </aside>

        <main class="min-w-0 flex-1 px-4 py-8 sm:px-8 lg:px-12 lg:py-10">
            <div class="mb-6 md:hidden">
                <button
                    type="button"
                    class="inline-flex items-center gap-2 text-sm font-medium text-muted-foreground hover:text-foreground"
                    x-on:click="sidebarOpen = true"
                >
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                    Menu
                </button>
            </div>

            <x-seo.breadcrumbs :items="$breadcrumbs ?? []" />

            @if(isset($pageMarkdown))
                <div class="mb-6 flex justify-end">
                    <x-docs-page-actions
                        :page-markdown="$pageMarkdown"
                        :page-url="$pageUrl"
                        :markdown-url="$markdownUrl"
                        :previous-page="$previousPage ?? null"
                        :next-page="$nextPage ?? null"
                    />
                </div>
            @endif

            <article class="docs-prose max-w-3xl">
                @if(isset($html))
                    {!! $html !!}
                @else
                    @yield('content')
                @endif
            </article>

            @if (isset($previousPage) || isset($nextPage))
                <x-docs-page-nav
                    :previous-page="$previousPage ?? null"
                    :next-page="$nextPage ?? null"
                />
            @endif

            <footer class="mt-16 border-t border-border py-8 text-xs text-muted-foreground">
                @if(isset($lastModifiedDate))
                    Last updated <time datetime="{{ $lastModifiedDate->toAtomString() }}">{{ $lastModifiedDate->format('F j, Y') }}</time>.
                @endif
                <span class="mx-2">·</span>
                <a href="{{ route('legal.index') }}" class="underline underline-offset-4 hover:text-foreground">Legal</a>
            </footer>
        </main>

        <aside class="sticky top-14 hidden h-[calc(100vh-3.5rem)] w-64 shrink-0 overflow-y-auto xl:block">
            <div class="px-4 py-10">
                @if(isset($headings) && count($headings) > 0)
                    <p class="mb-3 text-xs font-medium text-muted-foreground">On this page</p>
                    <nav class="relative border-s border-border text-sm">
                        @foreach ($headings as $heading)
                            <a
                                href="#{{ $heading['id'] }}"
                                class="block border-s-2 py-1 text-[0.8125rem] transition-colors"
                                :class="activeHeading === '{{ $heading['id'] }}'
                                    ? 'border-foreground text-foreground font-medium'
                                    : 'border-transparent text-muted-foreground hover:text-foreground'"
                                style="padding-inline-start: {{ $heading['level'] === 'h3' ? '1.25rem' : ($heading['level'] === 'h4' ? '2rem' : '0.75rem') }}"
                            >
                                {{ $heading['text'] }}
                            </a>
                        @endforeach
                    </nav>
                @endif

                <div class="mt-8 space-y-2 text-xs text-muted-foreground">
                    <a
                        href="https://github.com/electrikhq/electrik/issues/new"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="block hover:text-foreground"
                    >
                        Question? Give us feedback →
                    </a>
                    <button
                        type="button"
                        class="block hover:text-foreground"
                        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    >
                        Scroll to top
                    </button>
                </div>
            </div>
        </aside>
    </div>

    <x-slate::toaster />
</body>

</html>
