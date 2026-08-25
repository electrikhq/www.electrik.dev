@props([
    'variant' => 'section', // section | compact
])

@php
    $newsletter = config('site.newsletter', []);
    $enabled = (bool) ($newsletter['enabled'] ?? false);
    // Static Pages Function handles POST /newsletter/subscribe (Kit API server-side).
    $subscribeUrl = '/newsletter/subscribe';
@endphp

@if ($enabled)
    @if ($variant === 'compact')
        <div
            class="w-full max-w-md"
            x-data="electrikNewsletter({ action: @js($subscribeUrl) })"
        >
            <form class="flex flex-col gap-2 sm:flex-row sm:items-stretch" @submit.prevent="submit">
                <label class="sr-only" for="newsletter-email-compact">Email</label>
                <input
                    id="newsletter-email-compact"
                    type="email"
                    name="email"
                    required
                    autocomplete="email"
                    x-model="email"
                    :disabled="status === 'loading' || status === 'success'"
                    placeholder="you@company.com"
                    class="h-10 w-full min-w-0 flex-1 rounded-md border border-border bg-background px-3 text-sm text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:opacity-60"
                />
                <div class="absolute -left-[5000px]" aria-hidden="true">
                    <input type="text" name="company_website" tabindex="-1" autocomplete="off" x-model="honeypot" />
                </div>
                <x-slate::button
                    type="submit"
                    size="sm"
                    class="shrink-0"
                    x-bind:disabled="status === 'loading' || status === 'success'"
                >
                    <span x-show="status !== 'loading'">Subscribe</span>
                    <span x-cloak x-show="status === 'loading'">Sending…</span>
                </x-slate::button>
            </form>
            <p class="mt-2 min-h-5 text-left text-xs text-muted-foreground" x-cloak x-show="message" x-text="message"></p>
        </div>
    @else
        <x-slate-block::newsletter
            id="newsletter"
            title="Ship notes, not noise"
            description="Occasional updates on Electrik releases, install tips, and Laravel SaaS shipping."
        >
            <div x-data="electrikNewsletter({ action: @js($subscribeUrl) })">
                <form
                    class="flex w-full flex-col gap-3 sm:flex-row sm:items-stretch"
                    @submit.prevent="submit"
                >
                    <label class="sr-only" for="newsletter-email">Email</label>
                    <input
                        id="newsletter-email"
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
                        x-model="email"
                        :disabled="status === 'loading' || status === 'success'"
                        placeholder="you@company.com"
                        class="h-11 w-full min-w-0 flex-1 rounded-md border border-border bg-background px-3.5 text-sm text-foreground shadow-xs placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:opacity-60"
                    />
                    <div class="absolute -left-[5000px]" aria-hidden="true">
                        <input type="text" name="company_website" tabindex="-1" autocomplete="off" x-model="honeypot" />
                    </div>
                    <x-slate::button
                        type="submit"
                        class="shrink-0 sm:min-w-36"
                        x-bind:disabled="status === 'loading' || status === 'success'"
                    >
                        <span x-show="status !== 'loading'">Subscribe</span>
                        <span x-cloak x-show="status === 'loading'">Sending…</span>
                    </x-slate::button>
                </form>

                <p
                    class="mx-auto mt-3 max-w-lg text-sm"
                    :class="status === 'error' ? 'text-destructive' : 'text-muted-foreground'"
                    x-cloak
                    x-show="message"
                    x-text="message"
                ></p>

                <p class="mt-4 text-xs text-muted-foreground">
                    Unsubscribe anytime. We use Kit —
                    <a href="{{ route('legal.show', 'privacy') }}" class="underline underline-offset-4 hover:text-foreground">privacy</a>.
                </p>
            </div>
        </x-slate-block::newsletter>
    @endif
@endif
