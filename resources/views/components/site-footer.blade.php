<footer class="site-footer border-t">
    <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-12 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <p class="text-sm">
            Electrik · <a href="{{ route('license') }}" class="underline underline-offset-4 hover:text-[var(--home-ink)]">BSL 1.1</a>
        </p>
        <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm">
            <a href="{{ route('docs.show') }}" class="hover:text-[var(--home-ink)]">Docs</a>
            <a href="{{ route('install') }}" class="hover:text-[var(--home-ink)]">Install</a>
            <a href="{{ route('pricing') }}" class="hover:text-[var(--home-ink)]">Pricing</a>
            <a href="{{ route('launch') }}" class="hover:text-[var(--home-ink)]">Launch</a>
            <a href="{{ config('site.github_url') }}" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--home-ink)]">GitHub</a>
            <a href="{{ route('contact') }}" class="hover:text-[var(--home-ink)]">Contact</a>
        </div>
    </div>
</footer>
