<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\YamlFrontMatter\YamlFrontMatter;

function legalHubSections(): array
{
    $sections = config('legal.sections', []);

    foreach ($sections as &$section) {
        foreach ($section['documents'] as &$document) {
            if (! empty($document['slug'])) {
                $document = legalEnrichMarkdownDocument($document);
            } elseif (! empty($document['path'])) {
                $document['url'] = str_starts_with($document['path'], 'http')
                    ? $document['path']
                    : siteCanonicalUrl($document['path']);
            }
        }
    }

    return $sections;
}

/**
 * @return array{title: string, description: string, updated: ?string, html: string, lastModified: \Carbon\Carbon}
 */
function parseLegalDocument(string $slug): array
{
    $path = legalDocumentPath($slug);

    if (! File::exists($path)) {
        abort(404);
    }

    $document = YamlFrontMatter::parse(File::get($path));
    $body = Blade::render($document->body());
    $html = app(MarkdownRenderer::class)->convertToHtml($body)->getContent();

    return [
        'title' => (string) ($document->matter('title') ?: str($slug)->replace('-', ' ')->title()),
        'description' => (string) $document->matter('description'),
        'updated' => $document->matter('updated') ? (string) $document->matter('updated') : null,
        'html' => $html,
        'lastModified' => \Carbon\Carbon::createFromTimestamp(File::lastModified($path)),
    ];
}

function legalDocumentPath(string $slug): string
{
    return resource_path("content/legal/{$slug}.md");
}

function legalDocumentSlugs(): array
{
    $slugs = [];

    foreach (config('legal.sections', []) as $section) {
        foreach ($section['documents'] as $document) {
            if (! empty($document['slug'])) {
                $slugs[] = $document['slug'];
            }
        }
    }

    return array_values(array_unique($slugs));
}

function legalSiblingDocuments(string $activeSlug): array
{
    return collect(legalHubSections())
        ->flatMap(fn (array $section) => $section['documents'])
        ->filter(fn (array $document) => ! empty($document['slug']))
        ->map(function (array $document) use ($activeSlug) {
            return [
                'title' => $document['title'],
                'url' => route('legal.show', $document['slug']),
                'active' => ($document['slug'] ?? null) === $activeSlug,
            ];
        })
        ->values()
        ->all();
}

/**
 * @param  array{slug: string, title: string}  $document
 * @return array<string, mixed>
 */
function legalEnrichMarkdownDocument(array $document): array
{
    $path = legalDocumentPath($document['slug']);

    if (File::exists($path)) {
        $parsed = YamlFrontMatter::parse(File::get($path));
        $document['updated'] = $parsed->matter('updated') ? (string) $parsed->matter('updated') : null;
    }

    $document['url'] = route('legal.show', $document['slug']);

    return $document;
}

function legalFormatUpdatedDate(?string $updated): ?string
{
    if (! $updated) {
        return null;
    }

    try {
        return \Carbon\Carbon::parse($updated)->format('M Y');
    } catch (\Throwable) {
        return $updated;
    }
}
