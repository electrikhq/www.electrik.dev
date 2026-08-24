<?php

function siteCanonicalBaseUrl(): string
{
    $production = rtrim((string) (env('APP_PRODUCTION_URL') ?: ''), '/');

    if ($production !== '') {
        return $production;
    }

    return rtrim((string) config('app.url'), '/');
}

/**
 * Absolute public URL for a path (uses APP_PRODUCTION_URL during static export).
 *
 * Cloudflare Pages serves HTML exports as directories (`path/index.html`) and
 * 308-redirects bare paths to a trailing slash. Canonicals must match the
 * 200 URL. Real files (.md, images, json, xml, txt) keep no trailing slash.
 */
function siteCanonicalUrl(?string $path = null): string
{
    $base = siteCanonicalBaseUrl();
    $path = $path ?? '/';

    if ($path === '' || $path === '/') {
        return $base.'/';
    }

    $path = '/'.ltrim($path, '/');

    if (preg_match('/\.[a-z0-9]+$/i', $path)) {
        return $base.$path;
    }

    return $base.rtrim($path, '/').'/';
}

function siteSitemapLoc(string $productionBase, string $path): string
{
    $productionBase = rtrim($productionBase, '/');
    $path = trim($path, '/');

    if ($path === '') {
        return $productionBase.'/';
    }

    if (preg_match('/\.[a-z0-9]+$/i', $path)) {
        return $productionBase.'/'.$path;
    }

    return $productionBase.'/'.$path.'/';
}
