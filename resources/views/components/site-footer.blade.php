<footer class="border-t border-border">
    <div class="mx-auto flex max-w-[1400px] flex-col items-center gap-6 px-4 py-10 text-center text-sm text-muted-foreground sm:px-6">
        <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2">
            <a href="{{ route('install') }}" class="hover:text-foreground">Install</a>
            <a href="{{ route('pricing') }}" class="hover:text-foreground">Pricing</a>
            <a href="{{ route('license') }}" class="hover:text-foreground">License</a>
            <a href="{{ route('faq') }}" class="hover:text-foreground">FAQ</a>
            <a href="{{ route('contact') }}" class="hover:text-foreground">Contact</a>
            <a href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer" class="hover:text-foreground">Slate UI kit</a>
            <a href="{{ config('site.github_url') }}" target="_blank" rel="noopener noreferrer" class="hover:text-foreground">GitHub</a>
        </div>

        <p>
            Built by
            <a href="{{ config('site.studio.url') }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-4 hover:text-foreground">{{ config('site.studio.name') }}</a>
            /
            <a href="https://neerajkumar.name" target="_blank" rel="noopener noreferrer" class="underline underline-offset-4 hover:text-foreground">Neeraj Kumar</a>.
            UI by
            <a href="{{ config('site.slate_url') }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-4 hover:text-foreground">Slate</a>.
            Need a team?
            <a href="{{ route('contact') }}" class="underline underline-offset-4 hover:text-foreground">Get in touch</a>.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4">
            <x-openhunts-badge />
            <x-scrolllaunch-badge />
        </div>

        <p class="text-xs">
            &copy; {{ date('Y') }} Electrik. Source under
            <a href="{{ route('license') }}" class="underline underline-offset-4 hover:text-foreground">BSL 1.1</a>.
        </p>
    </div>
</footer>
