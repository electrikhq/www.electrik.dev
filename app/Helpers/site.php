<?php

function siteCanonicalBaseUrl(): string
{
    $production = rtrim((string) (env('APP_PRODUCTION_URL') ?: ''), '/');

    if ($production !== '') {
        return $production;
    }

    return rtrim((string) config('app.url'), '/');
}

function siteCanonicalUrl(?string $path = null): string
{
    $base = siteCanonicalBaseUrl();
    $path = $path ?? '/';

    if ($path === '' || $path === '/') {
        return $base.'/';
    }

    return $base.'/'.ltrim($path, '/');
}
