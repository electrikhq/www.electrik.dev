<div
    data-slot="docs-search"
    class="contents"
    x-data="docsSearch"
>
    {{-- Native control so we aren't fighting button's justify-center --}}
    <button
        type="button"
        class="hidden h-8 w-44 items-center justify-between gap-2 rounded-md border border-input bg-background px-2.5 text-sm text-muted-foreground shadow-xs transition-colors hover:bg-accent hover:text-accent-foreground sm:inline-flex md:w-56 dark:border-input dark:bg-input/30 dark:hover:bg-input/50"
        x-on:click="openSearch()"
        aria-label="Search documentation"
    >
        <span class="inline-flex min-w-0 items-center gap-2">
            <svg class="size-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" stroke-linecap="round" />
            </svg>
            <span class="truncate">Search documentation…</span>
        </span>
        <span class="inline-flex shrink-0 items-center gap-0.5">
            <x-slate::kbd>
                <span x-text="isMac() ? '⌘' : 'Ctrl'"></span>
            </x-slate::kbd>
            <x-slate::kbd>K</x-slate::kbd>
        </span>
    </button>

    <x-slate::button
        type="button"
        variant="ghost"
        size="icon-sm"
        class="sm:hidden"
        x-on:click="openSearch()"
        aria-label="Search documentation"
    >
        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" stroke-linecap="round" />
        </svg>
    </x-slate::button>

    <template x-teleport="body">
        <div
            data-slot="docs-search-portal"
            x-show="open"
            x-cloak
            class="relative z-50"
        >
            <div
                data-slot="docs-search-overlay"
                class="fixed inset-0 z-50 bg-black/50"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-on:click="close()"
            ></div>

            <div
                data-slot="docs-search-panel"
                role="dialog"
                aria-modal="true"
                aria-label="Search documentation"
                class="fixed inset-x-4 top-[12%] z-[51] mx-auto flex max-h-[min(32rem,72vh)] w-full max-w-lg -translate-y-0 flex-col overflow-hidden rounded-xl border bg-background shadow-lg outline-none sm:inset-x-auto sm:start-1/2 sm:-translate-x-1/2"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                x-on:click.stop
            >
                <div class="flex items-center gap-2 border-b border-border px-3">
                    <svg class="size-4 shrink-0 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" stroke-linecap="round" />
                    </svg>
                    <input
                        type="search"
                        x-ref="searchInput"
                        x-model="query"
                        x-on:input="onQueryInput()"
                        placeholder="Search documentation…"
                        autocomplete="off"
                        autocorrect="off"
                        spellcheck="false"
                        class="h-12 w-full bg-transparent text-sm outline-none placeholder:text-muted-foreground"
                        aria-autocomplete="list"
                        aria-controls="docs-search-results"
                    />
                    <x-slate::kbd>Esc</x-slate::kbd>
                </div>

                <div
                    id="docs-search-results"
                    class="min-h-0 flex-1 overflow-y-auto p-2"
                    role="listbox"
                >
                    <template x-if="loading && !ready">
                        <div class="flex items-center justify-center gap-2 px-3 py-8 text-sm text-muted-foreground">
                            <x-slate::spinner class="size-4" />
                            Loading index…
                        </div>
                    </template>

                    <template x-if="error">
                        <div class="px-3 py-8 text-center text-sm text-destructive" x-text="error"></div>
                    </template>

                    <template x-if="ready && query.trim() === '' && !error">
                        <div class="px-3 py-8 text-center text-sm text-muted-foreground">
                            Type to search documentation.
                        </div>
                    </template>

                    <template x-if="ready && query.trim() !== '' && results.length === 0 && !error">
                        <x-slate::empty
                            class="border-0 p-6 md:p-8"
                            title="No results"
                            description="Try a different query or browse the sidebar."
                        >
                            <x-slot:media>
                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" stroke-linecap="round" />
                                </svg>
                            </x-slot:media>
                        </x-slate::empty>
                    </template>

                    <template x-for="group in groupedResults()" :key="group.section">
                        <div class="mb-2">
                            <p class="px-2 py-1.5 text-xs font-medium text-muted-foreground" x-text="group.section"></p>
                            <template x-for="result in group.items" :key="result.id">
                                <a
                                    :href="result.url"
                                    role="option"
                                    class="flex flex-col gap-0.5 rounded-lg px-3 py-2 text-start transition-colors"
                                    :class="resultIndex(result) === activeIndex
                                        ? 'bg-accent text-accent-foreground'
                                        : 'hover:bg-muted'"
                                    :aria-selected="resultIndex(result) === activeIndex"
                                    x-on:mouseenter="activeIndex = resultIndex(result)"
                                    x-on:click="close()"
                                >
                                    <span class="text-sm font-medium" x-text="result.title"></span>
                                    <span
                                        class="line-clamp-1 text-xs text-muted-foreground"
                                        :class="resultIndex(result) === activeIndex && 'text-accent-foreground/80'"
                                        x-text="result.description || result.url"
                                    ></span>
                                </a>
                            </template>
                        </div>
                    </template>
                </div>

                <div class="flex items-center justify-between gap-3 border-t border-border px-3 py-2 text-xs text-muted-foreground">
                    <div class="inline-flex items-center gap-2">
                        <span class="inline-flex items-center gap-1">
                            <x-slate::kbd>↑</x-slate::kbd>
                            <x-slate::kbd>↓</x-slate::kbd>
                            <span>Navigate</span>
                        </span>
                        <span class="inline-flex items-center gap-1">
                            <x-slate::kbd>↵</x-slate::kbd>
                            <span>Open</span>
                        </span>
                    </div>
                    <span class="hidden sm:inline">Electrik docs search</span>
                </div>
            </div>
        </div>
    </template>
</div>
