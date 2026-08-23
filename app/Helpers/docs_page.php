<?php

function docsCanonicalBaseUrl(): string
{
    return siteCanonicalBaseUrl();
}

/**
 * Absolute public URL for a path (uses APP_PRODUCTION_URL during static export).
 */
function docsCanonicalUrl(?string $path = null): string
{
    return siteCanonicalUrl($path);
}

function docsAiPromptUrl(string $baseUrl, string $pageUrl): string
{
    $prompt = "I'm looking at this Electrik documentation: {$pageUrl}.\nHelp me understand how to use it. Be ready to explain concepts, give examples, or help debug based on it.\n";

    return $baseUrl.'?q='.rawurlencode($prompt);
}

function escapeBladeSyntax(string $content): string
{
    return str_replace(
        ['@', '{!!', '{{'],
        ['@@', '@{!!', '@{{'],
        $content
    );
}

function escapeBladeInDocumentationHtml(string $html): string
{
    $html = preg_replace_callback(
        '/(<code[^>]*class="[^"]*language-blade[^"]*"[^>]*>)(.*?)(<\/code>)/s',
        static fn (array $matches): string => $matches[1].escapeBladeSyntax($matches[2]).$matches[3],
        $html
    ) ?? $html;

    $html = preg_replace_callback(
        '/(<pre[^>]*>)(.*?)(<\/pre>)/s',
        static fn (array $matches): string => $matches[1].escapeBladeSyntax($matches[2]).$matches[3],
        $html
    ) ?? $html;

    return $html;
}
