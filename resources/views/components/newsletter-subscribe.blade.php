@props([
    'variant' => 'section', // section | compact
])

@php
    $newsletter = config('site.newsletter', []);
    $enabled = ($newsletter['enabled'] ?? false)
        && filled($newsletter['form_uid'] ?? config('services.kit.form_uid'));
    $formUid = (string) ($newsletter['form_uid'] ?? config('services.kit.form_uid'));
    // Static Cloudflare Pages has no Laravel — Kit embed is the live signup path.
    $embedSrc = $formUid !== '' ? "https://electrik.kit.com/{$formUid}/index.js" : null;
@endphp

@if ($enabled && $embedSrc)
    @if ($variant === 'compact')
        <div class="w-full max-w-md">
            <script async data-uid="{{ $formUid }}" src="{{ $embedSrc }}"></script>
        </div>
    @else
        <x-slate-block::newsletter
            id="newsletter"
            title="Ship notes, not noise"
            description="Occasional updates on Electrik releases, install tips, and Laravel SaaS shipping."
        >
            <div class="mx-auto w-full max-w-lg">
                <script async data-uid="{{ $formUid }}" src="{{ $embedSrc }}"></script>
            </div>
            <p class="mt-4 text-xs text-muted-foreground">
                Unsubscribe anytime. We use Kit —
                <a href="{{ route('legal.show', 'privacy') }}" class="underline underline-offset-4 hover:text-foreground">privacy</a>.
            </p>
        </x-slate-block::newsletter>
    @endif
@endif
