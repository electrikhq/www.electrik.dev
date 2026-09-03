@props([
    'docs' => false,
    'sections' => [],
])

@php
    $navActive = 'text-sm font-medium text-foreground';
    $navLink = 'text-sm text-muted-foreground transition-colors hover:text-foreground';
    $isActive = fn (string $name): string => request()->routeIs($name) ? $navActive : $navLink;
    $docsActive = request()->routeIs('docs.*') ? $navActive : $navLink;
    $githubUrl = (string) config('site.github_url');
    $githubRepo = trim((string) parse_url($githubUrl, PHP_URL_PATH), '/');

    $menuLinks = [
        ['label' => 'Home', 'href' => route('home')],
        ['label' => 'Docs', 'href' => route('docs.show')],
        ['label' => 'Install', 'href' => route('install')],
        ['label' => 'Pricing', 'href' => route('pricing')],
        ['label' => 'Tools', 'href' => route('tools.index')],
        ['label' => 'Compare', 'href' => route('compare.index')],
        ['label' => 'License', 'href' => route('license')],
        ['label' => 'FAQ', 'href' => route('faq')],
        ['label' => 'Slate UI', 'href' => config('site.slate_url'), 'external' => true],
        ['label' => 'Demo', 'href' => config('site.demo_url'), 'external' => true],
    ];

    $sectionLinks = collect($sections)
        ->filter(fn ($item) => ($item['type'] ?? null) === 'section')
        ->map(function (array $item) {
            $first = collect($item['children'] ?? [])->firstWhere('type', 'file');

            return [
                'label' => $item['title'] ?? '',
                'href' => $first['link'] ?? null,
            ];
        })
        ->filter(fn ($item) => filled($item['label']) && filled($item['href']))
        ->values()
        ->all();
@endphp

<div
    class="contents"
    x-data="{
        menuOpen: false,
        stars: null,
        init() {
            const repo = @js($githubRepo);
            if (repo) {
                fetch('https://api.github.com/repos/' + repo)
                    .then((r) => r.ok ? r.json() : null)
                    .then((data) => {
                        if (data?.stargazers_count != null) this.stars = data.stargazers_count;
                    })
                    .catch(() => {});
            }
            this.$watch('menuOpen', (open) => {
                document.documentElement.classList.toggle('overflow-hidden', !!open);
            });
            const mq = window.matchMedia('(min-width: 1024px)');
            const onChange = () => { if (mq.matches) this.close(); };
            mq.addEventListener('change', onChange);
            this._mq = mq;
            this._onChange = onChange;
        },
        destroy() {
            document.documentElement.classList.remove('overflow-hidden');
            this._mq?.removeEventListener('change', this._onChange);
        },
        label(n) {
            if (n >= 1000) {
                const value = n / 1000;
                return (value >= 10 ? value.toFixed(0) : value.toFixed(1).replace(/\.0$/, '')) + 'k';
            }
            return String(n);
        },
        close() { this.menuOpen = false; },
        toggle() { this.menuOpen = ! this.menuOpen; }
    }"
    x-on:keydown.escape.window="if (menuOpen) close()"
>
    <header class="sticky top-0 z-[60] h-14 border-b border-border/80 bg-background/80 backdrop-blur-xl">
        <div class="mx-auto flex h-full w-full max-w-full items-center gap-4 px-4 sm:px-6">
            {{-- Mobile: Menu trigger --}}
            <button
                type="button"
                class="inline-flex items-center gap-2 rounded-md px-1.5 py-1.5 text-sm font-semibold tracking-tight text-foreground transition-colors hover:bg-accent/60 lg:hidden"
                x-on:click="toggle()"
                x-bind:aria-expanded="menuOpen.toString()"
                aria-controls="site-menu-panel"
                aria-label="Menu"
            >
                <svg x-show="!menuOpen" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 8h16" />
                    <path stroke-linecap="round" d="M4 16h16" />
                </svg>
                <svg x-cloak x-show="menuOpen" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M18 6 6 18" />
                    <path stroke-linecap="round" d="m6 6 12 12" />
                </svg>
                <span>Menu</span>
            </button>

            {{-- Desktop: brand --}}
            <a href="{{ route('home') }}" class="hidden shrink-0 items-center gap-2 text-foreground lg:flex">
                <img src="{{ asset('images/electrik-mark.svg') }}" alt="" width="24" height="24" class="size-6" decoding="async" />
                <span class="text-sm font-medium tracking-tight">{{ config('site.name') }}</span>
            </a>

            {{-- Desktop: primary links --}}
            <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('docs.show') }}" class="{{ $docsActive }}">Docs</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('install') }}" class="{{ $isActive('install') }}">Install</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('pricing') }}" class="{{ $isActive('pricing') }}">Pricing</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('tools.index') }}" class="{{ $isActive('tools.*') }}">Tools</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('compare.index') }}" class="{{ $isActive('compare.*') }}">Compare</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('license') }}" class="{{ $isActive('license') }}">License</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ route('faq') }}" class="{{ $isActive('faq') }}">FAQ</x-slate::button>
                <x-slate::button as="a" variant="ghost" size="sm" href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer">Slate UI</x-slate::button>
            </nav>

            <div class="ml-auto flex items-center gap-2 sm:gap-3">
                @if ($docs)
                    <div class="flex items-center" x-show="!menuOpen">
                        <x-docs-search />
                    </div>
                @endif

                {{-- Mobile right cluster (matches expanded-menu chrome) --}}
                <div class="flex items-center gap-2 sm:gap-3 lg:hidden">
                    <a
                        href="{{ $githubUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 text-sm text-muted-foreground transition-colors hover:text-foreground"
                        aria-label="GitHub"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="size-4 text-foreground" aria-hidden="true">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        <span class="min-w-[1.25rem] tabular-nums" x-text="stars != null ? label(stars) : ''"></span>
                    </a>
                    <span class="h-4 w-px bg-border" aria-hidden="true"></span>
                    <x-slate::dark-mode-toggle variant="ghost" size="icon-sm" />
                    <span class="h-4 w-px bg-border" aria-hidden="true"></span>
                    <x-slate::button as="a" size="sm" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer" class="rounded-full px-4">
                        Try demo
                    </x-slate::button>
                </div>

                {{-- Desktop right actions --}}
                <div class="hidden items-center gap-2 lg:flex">
                    <x-slate::button as="a" variant="ghost" size="sm" href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="size-4" aria-hidden="true">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        GitHub
                    </x-slate::button>
                    <x-slate::dark-mode-toggle variant="ghost" />
                    <x-slate::button as="a" variant="outline" size="sm" href="{{ route('install') }}">
                        Install
                    </x-slate::button>
                    <x-slate::button as="a" size="sm" href="{{ config('site.demo_url') }}" target="_blank" rel="noopener noreferrer">
                        Try the demo
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                        </svg>
                    </x-slate::button>
                </div>
            </div>
        </div>
    </header>

    <div
        id="site-menu-panel"
        x-cloak
        x-show="menuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto bg-background pt-14 lg:hidden"
        role="dialog"
        aria-modal="true"
        aria-label="Site menu"
    >
        <nav class="mx-auto w-full max-w-full px-6 py-8 sm:px-8" aria-label="Mobile">
            <div>
                <p class="mb-4 text-sm text-muted-foreground">Menu</p>
                <ul class="space-y-1">
                    @foreach ($menuLinks as $link)
                        <li>
                            <a
                                href="{{ $link['href'] }}"
                                @if (! empty($link['external'])) target="_blank" rel="noopener noreferrer" @endif
                                x-on:click="close()"
                                class="block py-1 text-3xl font-semibold tracking-tight text-foreground transition-opacity hover:opacity-70"
                            >
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if (count($sectionLinks) > 0)
                <div class="mt-12">
                    <p class="mb-4 text-sm text-muted-foreground">Sections</p>
                    <ul class="space-y-1">
                        @foreach ($sectionLinks as $link)
                            <li>
                                <a
                                    href="{{ $link['href'] }}"
                                    x-on:click="close()"
                                    class="block py-1 text-3xl font-semibold tracking-tight text-foreground transition-opacity hover:opacity-70"
                                >
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </nav>
    </div>
</div>
