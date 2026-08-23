@props([
    'pageMarkdown' => '',
    'pageUrl' => '',
    'markdownUrl' => '',
    'previousPage' => null,
    'nextPage' => null,
])

@php
    // Canonical host from APP_PRODUCTION_URL during export; Alpine rewrites from
    // window.location so local preview and production both stay accurate.
    $v0Url = docsAiPromptUrl('https://v0.dev/chat', $pageUrl);
    $chatGptUrl = docsAiPromptUrl('https://chatgpt.com/', $pageUrl);
    $claudeUrl = docsAiPromptUrl('https://claude.ai/new', $pageUrl);
    $sciraUrl = docsAiPromptUrl('https://scira.ai/', $pageUrl);
    $markdownHref = parse_url($markdownUrl, PHP_URL_PATH) ?: $markdownUrl;
@endphp

<div
    {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}
    x-data="{
        open: false,
        copied: false,
        v0Url: @js($v0Url),
        chatGptUrl: @js($chatGptUrl),
        claudeUrl: @js($claudeUrl),
        sciraUrl: @js($sciraUrl),
        init() {
            const pageUrl = window.location.href.split('#')[0];
            const prompt = `I'm looking at this Electrik documentation: ${pageUrl}.\nHelp me understand how to use it. Be ready to explain concepts, give examples, or help debug based on it.\n`;
            const q = encodeURIComponent(prompt);
            this.v0Url = `https://v0.dev/chat?q=${q}`;
            this.chatGptUrl = `https://chatgpt.com/?q=${q}`;
            this.claudeUrl = `https://claude.ai/new?q=${q}`;
            this.sciraUrl = `https://scira.ai/?q=${q}`;
        },
        copyPage() {
            navigator.clipboard.writeText(this.$refs.pageSource.value).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            });
        }
    }"
    x-on:keydown.escape.window="open = false"
>
    <div class="relative">
        <div class="inline-flex items-stretch overflow-hidden rounded-lg">
            <x-slate::button
                type="button"
                variant="secondary"
                size="sm"
                class="rounded-none rounded-s-lg shadow-none"
                x-on:click="copyPage()"
            >
                <svg x-show="!copied" class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                </svg>
                <svg x-show="copied" x-cloak class="size-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M20 6 9 17l-5-5" />
                </svg>
                <span x-text="copied ? 'Copied' : 'Copy Page'">Copy Page</span>
            </x-slate::button>

            <x-slate::button
                type="button"
                variant="secondary"
                size="icon-sm"
                class="rounded-none rounded-e-lg border-s border-secondary-foreground/10 shadow-none"
                x-on:click="open = !open"
                aria-label="Open menu"
                x-bind:aria-expanded="open"
            >
                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </x-slate::button>
        </div>

        <div
            x-show="open"
            x-cloak
            x-on:click.outside="open = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-lg border border-border bg-background p-1 shadow-lg"
        >
            <a
                href="{{ $markdownHref }}"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-2 rounded-md px-2 py-1.5 text-sm text-foreground transition-colors hover:bg-accent"
                x-on:click="open = false"
            >
                <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" />
                </svg>
                View as Markdown
            </a>

            <a
                x-bind:href="v0Url"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-2 rounded-md px-2 py-1.5 text-sm text-foreground transition-colors hover:bg-accent"
                x-on:click="open = false"
            >
                <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                Open in v0
            </a>

            <a
                x-bind:href="chatGptUrl"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-2 rounded-md px-2 py-1.5 text-sm text-foreground transition-colors hover:bg-accent"
                x-on:click="open = false"
            >
                <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M22.282 9.821a5.985 5.985 0 0 0-.516-4.91 6.046 6.046 0 0 0-6.51-2.9A6.065 6.065 0 0 0 4.981 4.18a5.985 5.985 0 0 0-3.998 2.9 6.046 6.046 0 0 0 .742 7.097 5.98 5.98 0 0 0 .511 4.911 6.051 6.051 0 0 0 6.514 2.899A5.985 5.985 0 0 0 13.26 24a6.056 6.056 0 0 0 5.772-4.206 5.99 5.99 0 0 0 3.997-2.9 6.056 6.056 0 0 0-.747-7.073zM13.26 22.43a4.476 4.476 0 0 1-2.876-1.04l.141-.081 4.779-2.758a.795.795 0 0 0 .392-.681v-6.737l2.02 1.168a.071.071 0 0 1 .038.052v5.583a4.504 4.504 0 0 1-4.494 4.494zM3.6 18.304a4.47 4.47 0 0 1-.535-3.014l.142.085 4.783 2.759a.771.771 0 0 0 .78 0l5.843-3.369v2.332a.08.08 0 0 1-.033.062L9.74 19.95a4.5 4.5 0 0 1-6.14-1.646zM2.34 7.896a4.485 4.485 0 0 1 2.365-1.972V11.6a.766.766 0 0 0 .388.676l5.815 3.355-2.02 1.168a.076.076 0 0 1-.071 0l-4.83-2.786A4.504 4.504 0 0 1 2.34 7.872zm16.597 3.855-5.833-3.387L15.119 7.2a.076.076 0 0 1 .071 0l4.83 2.791a4.494 4.494 0 0 1-.676 8.105v-5.678a.79.79 0 0 0-.407-.667zm2.01-3.023-.141-.085-4.773-2.781a.776.776 0 0 0-.785 0L9.409 9.23V6.897a.066.066 0 0 1 .028-.061l4.83-2.787a4.5 4.5 0 0 1 6.68 4.66zm-12.64 4.135-2.02-1.164a.08.08 0 0 1-.038-.057V6.955a4.5 4.5 0 0 1 7.375-3.453l-.142.08-4.778 2.758a.795.795 0 0 0-.393.681zm1.093-2.365 2.602-1.5 2.607 1.5v2.999l-2.597 1.5-2.607-1.5z" />
                </svg>
                Open in ChatGPT
            </a>

            <a
                x-bind:href="claudeUrl"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-2 rounded-md px-2 py-1.5 text-sm text-foreground transition-colors hover:bg-accent"
                x-on:click="open = false"
            >
                <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2c1.5 0 2.9.6 3.9 1.7L12 8.6 8.1 3.7C9.1 2.6 10.5 2 12 2zm0 20c-1.5 0-2.9-.6-3.9-1.7L12 15.4l3.9 4.9A5.5 5.5 0 0 1 12 22zm7.1-3.3a5.5 5.5 0 0 0 0-7.4L16.5 12l2.6 3.3a5.5 5.5 0 0 0 0 4.4zm-14.2 0a5.5 5.5 0 0 0 0-4.4L7.5 12 4.9 8.7a5.5 5.5 0 0 0 0 7.4zM12 10.8 9.6 8.1 12 5.4l2.4 2.7L12 10.8z" />
                </svg>
                Open in Claude
            </a>

            <a
                x-bind:href="sciraUrl"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-2 rounded-md px-2 py-1.5 text-sm text-foreground transition-colors hover:bg-accent"
                x-on:click="open = false"
            >
                <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                </svg>
                Open in Scira
            </a>
        </div>
    </div>

    @if ($previousPage)
        <x-slate::button
            as="a"
            href="{{ $previousPage['link'] }}"
            variant="secondary"
            size="icon-sm"
            class="shadow-none"
            aria-label="Previous page: {{ $previousPage['title'] }}"
            title="{{ $previousPage['title'] }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </x-slate::button>
    @endif

    @if ($nextPage)
        <x-slate::button
            as="a"
            href="{{ $nextPage['link'] }}"
            variant="secondary"
            size="icon-sm"
            class="shadow-none"
            aria-label="Next page: {{ $nextPage['title'] }}"
            title="{{ $nextPage['title'] }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </x-slate::button>
    @endif

    <textarea class="sr-only" x-ref="pageSource" readonly aria-hidden="true">{{ $pageMarkdown }}</textarea>
</div>
