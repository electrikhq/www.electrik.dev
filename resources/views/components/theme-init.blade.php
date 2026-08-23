{{-- Apply stored theme before paint to avoid a flash. --}}
<script>
    (function () {
        try {
            var stored = localStorage.getItem('slate-theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var dark = stored === 'dark' || (stored !== 'light' && prefersDark);

            document.documentElement.classList.toggle('dark', dark);
        } catch (e) {}
    })();
</script>
