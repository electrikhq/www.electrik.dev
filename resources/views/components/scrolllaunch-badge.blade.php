{{-- ScrollLaunch: keep href and img src exact; rel=noopener only; keep ?ref=badge. --}}
<a
    href="https://www.scrolllaunch.com/products/electrik?ref=badge"
    target="_blank"
    rel="noopener"
    {{ $attributes->merge(['class' => 'inline-block']) }}
>
    <img
        src="https://www.scrolllaunch.com/api/badge/electrik"
        alt="Featured on ScrollLaunch"
        width="220"
        height="48"
        loading="lazy"
        class="h-auto w-[120px]"
    />
</a>
