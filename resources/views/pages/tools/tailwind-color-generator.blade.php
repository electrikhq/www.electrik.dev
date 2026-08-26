@extends('layouts.www')

@php
    $seoTitle = 'Tailwind Color Generator';
    $seoDescription = 'Free Tailwind CSS color palette generator. Create shade scales, harmony schemes, and export Tailwind v4 @theme CSS, v3 config, or Electrik Slate tokens.';
    $seoUrl = siteCanonicalUrl('/tools/tailwind-color-generator');
    $seoKeywords = [
        'tailwind color generator',
        'tailwind css color scheme generator',
        'tailwind palette generator',
        'tailwind v4 theme colors',
        'oklch color palette',
    ];
    $toolFaqs = [
        [
            'question' => 'What is a Tailwind color generator?',
            'answer' => 'A Tailwind color generator builds a full shade scale (50–950) from a base color so you can use classes like bg-brand-500 in Tailwind CSS. This tool also exports Tailwind v4 @theme CSS, classic v3 config, plain CSS variables, and Electrik Slate token overrides.',
        ],
        [
            'question' => 'Does this support Tailwind CSS v4?',
            'answer' => 'Yes. The default export is a Tailwind v4 @theme block with --color-{name}-{shade} custom properties. You can also export a Tailwind v3 theme.extend.colors snippet if you are still on config-based Tailwind.',
        ],
        [
            'question' => 'How do I use the palette in my project?',
            'answer' => 'Copy the Tailwind v4 @theme output into your CSS next to @import "tailwindcss", or paste the v3 JSON into theme.extend.colors. Then use utilities such as bg-brand-500, text-brand-700, and border-brand-200.',
        ],
        [
            'question' => 'What color harmony schemes are available?',
            'answer' => 'Monochromatic, analogous, complementary, triadic, tetradic, and split complementary. Each scheme derives related hues from your base color, then builds a full shade ramp plus a matching neutral scale.',
        ],
        [
            'question' => 'Can I export colors for Electrik Slate?',
            'answer' => 'Yes. Choose the Slate tokens export to override --slate-primary and related tokens used by electrik/slate and Electrik apps, without replacing your whole Tailwind palette.',
        ],
        [
            'question' => 'How many shades should I generate?',
            'answer' => 'Eleven shades (50–950) match Tailwind’s default color scales and are best for design systems. Use nine or five for simpler brand kits.',
        ],
    ];
    $seoGraph = \App\Support\Seo::graph(
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph([
            ['name' => 'Home', 'url' => siteCanonicalUrl('/')],
            ['name' => 'Tools', 'url' => siteCanonicalUrl('/tools')],
            ['name' => 'Tailwind Color Generator', 'url' => siteCanonicalUrl('/tools/tailwind-color-generator')],
        ]),
        \App\Support\Seo::faqPageGraph($seoUrl, $toolFaqs),
        [
            '@type' => 'WebApplication',
            '@id' => siteCanonicalUrl('/tools/tailwind-color-generator').'#app',
            'name' => 'Tailwind Color Generator',
            'url' => siteCanonicalUrl('/tools/tailwind-color-generator'),
            'applicationCategory' => 'DeveloperApplication',
            'operatingSystem' => 'Any',
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'USD',
            ],
            'description' => $seoDescription,
            'isPartOf' => ['@id' => siteCanonicalUrl('/').'#website'],
        ],
    );
@endphp

@section('content')
<section class="relative overflow-hidden border-b border-border px-4 pb-12 pt-14 sm:px-6 sm:pt-18">
    <div
        class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_70%_50%_at_20%_-10%,color-mix(in_oklch,var(--slate-foreground)_7%,transparent),transparent)]"
        aria-hidden="true"
    ></div>
    <div class="mx-auto max-w-3xl">
        <p class="font-mono text-xs tracking-[0.18em] text-muted-foreground uppercase">
            <a href="{{ route('tools.index') }}" class="hover:text-foreground">Free tools</a>
            <span class="mx-2 text-border">/</span>
            Colors
        </p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Tailwind color generator</h1>
        <p class="mt-4 text-lg text-muted-foreground text-pretty">
            Build Tailwind-ready shade scales from a base color. Export
            <strong class="font-medium text-foreground">v4 @theme</strong>,
            classic config, CSS variables, or Electrik Slate tokens — free, no signup.
        </p>
    </div>
</section>

<section
    class="px-4 py-10 sm:px-6"
    x-data="tailwindColorGenerator"
>
    <div class="mx-auto grid max-w-[1400px] gap-10 lg:grid-cols-[minmax(0,22rem)_minmax(0,1fr)]">
        <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
            <div class="space-y-4 border-t border-border pt-6">
                <h2 class="text-sm font-semibold tracking-tight">Color options</h2>

                <div>
                    <label class="text-xs font-medium text-muted-foreground" for="base-color">Base color</label>
                    <div class="mt-2 flex items-center gap-3">
                        <input
                            id="base-color"
                            type="color"
                            x-model="baseHex"
                            class="size-11 cursor-pointer rounded-md border border-border bg-background p-1"
                        />
                        <input
                            type="text"
                            x-model="baseHex"
                            maxlength="7"
                            class="h-11 w-full rounded-md border border-border bg-background px-3 font-mono text-sm"
                            aria-label="Base color hex"
                        />
                    </div>
                </div>

                <div>
                    <label class="text-xs font-medium text-muted-foreground" for="color-name">Color name</label>
                    <input
                        id="color-name"
                        type="text"
                        x-model="colorName"
                        class="mt-2 h-11 w-full rounded-md border border-border bg-background px-3 text-sm"
                        placeholder="brand"
                    />
                </div>

                <div>
                    <label class="text-xs font-medium text-muted-foreground" for="scheme">Color scheme</label>
                    <select
                        id="scheme"
                        x-model="scheme"
                        class="mt-2 h-11 w-full rounded-md border border-border bg-background px-3 text-sm"
                    >
                        <template x-for="item in schemes" :key="item.id">
                            <option :value="item.id" x-text="item.label"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <p class="text-xs font-medium text-muted-foreground">Number of shades</p>
                    <div class="mt-2 grid grid-cols-3 gap-2">
                        <template x-for="n in [5, 9, 11]" :key="n">
                            <button
                                type="button"
                                class="h-10 rounded-md border text-sm"
                                x-on:click="shadeCount = n"
                                x-bind:class="shadeCount === n ? 'border-foreground bg-foreground text-background' : 'border-border bg-background text-foreground hover:bg-muted/40'"
                                x-text="n"
                            ></button>
                        </template>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between gap-3">
                        <label class="text-xs font-medium text-muted-foreground" for="saturation">Saturation</label>
                        <span class="font-mono text-xs text-muted-foreground" x-text="saturation + '%'"></span>
                    </div>
                    <input
                        id="saturation"
                        type="range"
                        min="0"
                        max="100"
                        x-model.number="saturation"
                        class="mt-3 w-full accent-foreground"
                    />
                </div>
            </div>

            <div class="space-y-3 border-t border-border pt-6">
                <h2 class="text-sm font-semibold tracking-tight">Contrast</h2>
                <p class="text-sm text-muted-foreground">
                    Mid shade vs white
                    <span class="font-mono text-foreground" x-text="ratioText(contrastWhite)"></span>
                    · <span x-text="wcag(primaryMid, '#ffffff')"></span>
                </p>
                <p class="text-sm text-muted-foreground">
                    Mid shade vs near-black
                    <span class="font-mono text-foreground" x-text="ratioText(contrastBlack)"></span>
                    · <span x-text="wcag(primaryMid, '#0a0a0a')"></span>
                </p>
            </div>
        </aside>

        <div class="space-y-10 min-w-0">
            <div>
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <h2 class="text-xl font-semibold tracking-tight">Generated palette</h2>
                    <p class="text-sm text-muted-foreground">Click a swatch to copy its hex</p>
                </div>

                <div class="mt-6 space-y-8">
                    <template x-for="family in families" :key="family.name">
                        <div>
                            <div class="mb-3 flex items-center justify-between gap-3">
                                <p class="text-sm font-medium" x-text="family.name"></p>
                                <p class="font-mono text-xs text-muted-foreground" x-text="'hue ' + family.hue + '°'"></p>
                            </div>
                            <div class="grid grid-cols-5 gap-2 sm:grid-cols-9 lg:grid-cols-11">
                                <template x-for="[step, hex] in shadeEntries(family)" :key="family.name + '-' + step">
                                    <button
                                        type="button"
                                        class="group flex aspect-square flex-col justify-between rounded-lg border border-border/60 p-2 text-left transition hover:scale-[1.02]"
                                        x-bind:style="`background-color: ${hex}; color: ${fgFor(hex)}`"
                                        x-on:click="navigator.clipboard.writeText(hex)"
                                        x-bind:title="'Copy ' + hex"
                                    >
                                        <span class="text-[10px] font-medium opacity-80" x-text="step"></span>
                                        <span class="truncate font-mono text-[10px] opacity-90" x-text="hex"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="border-t border-border pt-8">
                <h2 class="text-xl font-semibold tracking-tight">Preview</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div class="rounded-xl border border-border p-5" x-bind:style="`background: color-mix(in oklab, ${primaryMid} 8%, white)`">
                        <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Light surface</p>
                        <h3 class="mt-2 text-lg font-semibold tracking-tight">Ship with a clear brand color</h3>
                        <p class="mt-2 text-sm text-muted-foreground">Buttons and accents use your mid shade.</p>
                        <div class="mt-5 flex flex-wrap gap-2">
                            <button
                                type="button"
                                class="inline-flex h-10 items-center rounded-md px-4 text-sm font-medium"
                                x-bind:style="`background:${primaryMid};color:${primaryFg}`"
                            >
                                Primary action
                            </button>
                            <button
                                type="button"
                                class="inline-flex h-10 items-center rounded-md border px-4 text-sm font-medium"
                                x-bind:style="`border-color:${primaryMid};color:${primaryMid}`"
                            >
                                Secondary
                            </button>
                        </div>
                    </div>
                    <div class="rounded-xl border border-border bg-[#0c0c0c] p-5 text-white">
                        <p class="text-xs font-medium uppercase tracking-wider text-white/50">Dark surface</p>
                        <h3 class="mt-2 text-lg font-semibold tracking-tight">Same tokens, dark UI</h3>
                        <p class="mt-2 text-sm text-white/60">Useful when theming Electrik Slate or a SaaS shell.</p>
                        <div class="mt-5">
                            <div
                                class="rounded-lg border border-white/10 p-4"
                                x-bind:style="`background: color-mix(in oklab, ${primaryMid} 18%, #0c0c0c)`"
                            >
                                <p class="text-sm" x-bind:style="`color:${primaryMid}`">Accent callout on dark</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-border pt-8">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold tracking-tight">Export</h2>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="fmt in [
                            { id: 'v4', label: 'Tailwind v4' },
                            { id: 'v3', label: 'Tailwind v3' },
                            { id: 'css', label: 'CSS vars' },
                            { id: 'slate', label: 'Slate tokens' },
                        ]" :key="fmt.id">
                            <button
                                type="button"
                                class="h-9 rounded-md border px-3 text-xs font-medium"
                                x-on:click="exportFormat = fmt.id"
                                x-bind:class="exportFormat === fmt.id ? 'border-foreground bg-foreground text-background' : 'border-border text-foreground hover:bg-muted/40'"
                                x-text="fmt.label"
                            ></button>
                        </template>
                    </div>
                </div>
                <div class="mt-4 overflow-hidden rounded-xl border border-border bg-muted/20">
                    <div class="flex items-center justify-between gap-3 border-b border-border px-4 py-2">
                        <p class="font-mono text-xs text-muted-foreground" x-text="exportFormat === 'v4' ? 'app.css (@theme)' : (exportFormat === 'v3' ? 'tailwind.config.js' : (exportFormat === 'slate' ? 'slate overrides' : ':root'))"></p>
                        <button
                            type="button"
                            class="inline-flex h-8 items-center rounded-md border border-border bg-background px-3 text-xs font-medium hover:bg-muted/50"
                            x-on:click="copyExport()"
                            x-text="copied ? 'Copied' : 'Copy'"
                        ></button>
                    </div>
                    <pre class="max-h-[28rem] overflow-auto p-4 font-mono text-xs leading-relaxed text-foreground"><code x-text="exportCode"></code></pre>
                </div>
            </div>

            <div class="border-t border-border pt-8">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-semibold tracking-tight">Discover schemes</h2>
                        <p class="mt-1 text-sm text-muted-foreground">Curated starting points — click to apply.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="cat in categories" :key="cat">
                            <button
                                type="button"
                                class="h-8 rounded-md border px-2.5 text-xs"
                                x-on:click="presetFilter = cat"
                                x-bind:class="presetFilter === cat ? 'border-foreground bg-foreground text-background' : 'border-border text-muted-foreground hover:text-foreground'"
                                x-text="cat"
                            ></button>
                        </template>
                    </div>
                </div>
                <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    <template x-for="preset in filteredPresets" :key="preset.id">
                        <button
                            type="button"
                            class="flex items-center gap-3 rounded-xl border border-border p-3 text-left transition hover:bg-muted/30"
                            x-on:click="applyPreset(preset)"
                        >
                            <span class="size-10 shrink-0 rounded-md border border-border" x-bind:style="`background:${preset.hex}`"></span>
                            <span>
                                <span class="block text-sm font-medium" x-text="preset.label"></span>
                                <span class="block text-xs text-muted-foreground" x-text="preset.category + ' · ' + preset.hex"></span>
                            </span>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="border-t border-border px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-3xl">
        <h2 class="text-2xl font-semibold tracking-tight">Tailwind color generator FAQ</h2>
        <div class="mt-8 space-y-6">
            @foreach ($toolFaqs as $faq)
                <div>
                    <h3 class="text-base font-medium">{{ $faq['question'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $faq['answer'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="border-t border-border bg-muted/30 px-4 py-16 sm:px-6">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-2xl font-semibold tracking-tight">Built for Laravel + Slate</h2>
        <p class="mt-3 text-muted-foreground">
            Generate a palette here, then theme
            <a href="{{ config('site.slate_url') }}" class="underline underline-offset-4 hover:text-foreground" target="_blank" rel="noopener noreferrer">Electrik Slate</a>
            or ship a full SaaS shell with Electrik.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <x-slate::button as="a" href="{{ route('install') }}">Install Electrik</x-slate::button>
            <x-slate::button as="a" variant="outline" href="{{ config('site.slate_url') }}/themes" target="_blank" rel="noopener noreferrer">Slate themes</x-slate::button>
        </div>
    </div>
</section>
@endsection
