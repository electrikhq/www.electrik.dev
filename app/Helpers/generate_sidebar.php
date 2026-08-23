<?php

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

function generateSidebar(): array
{
    $docsPath = resource_path('content/docs/');
    $docsItems = buildSidebarTree($docsPath);
    $allItems = flattenSidebarLeaves($docsItems);

    return groupSidebarBySection($allItems);
}

function flattenSidebarLeaves(array $items): array
{
    $leaves = [];

    foreach ($items as $item) {
        if (($item['type'] ?? '') === 'folder') {
            $leaves = array_merge($leaves, flattenSidebarLeaves($item['children'] ?? []));

            continue;
        }

        if (($item['type'] ?? '') === 'file') {
            $leaves[] = $item;
        }
    }

    return $leaves;
}

function groupSidebarBySection(array $items): array
{
    $sections = [
        'Getting Started' => [],
        'Core Concepts' => [],
        'Guides' => [],
        'Reference' => [],
        'License & commercial' => [],
        'Ecosystem' => [],
        'Other' => [],
    ];

    foreach ($items as $item) {
        $section = $item['section'] ?? 'Other';

        if (! isset($sections[$section])) {
            $section = 'Other';
        }

        $sections[$section][] = $item;
    }

    $grouped = [];

    foreach ($sections as $sectionName => $sectionItems) {
        if ($sectionItems === []) {
            continue;
        }

        usort($sectionItems, function ($a, $b) {
            if (($a['order'] ?? null) === ($b['order'] ?? null)) {
                return strcasecmp((string) ($a['title'] ?? ''), (string) ($b['title'] ?? ''));
            }

            return ($a['order'] ?? PHP_INT_MAX) <=> ($b['order'] ?? PHP_INT_MAX);
        });

        $grouped[] = [
            'type' => 'section',
            'title' => $sectionName,
            'children' => $sectionItems,
        ];
    }

    return $grouped;
}

function buildSidebarTree(string $directory, string $baseUrl = '', string $routePrefix = 'docs'): array
{
    $items = [];

    if (! File::exists($directory)) {
        return $items;
    }

    $filesAndDirs = File::directories($directory);
    $files = File::files($directory);

    foreach ($filesAndDirs as $dir) {
        $folderName = basename($dir);
        $relativeUrl = $baseUrl.'/'.$folderName;
        $indexPath = $dir.'/index.md';

        $order = null;
        $section = null;

        if (File::exists($indexPath)) {
            $document = YamlFrontMatter::parse(File::get($indexPath));
            $order = $document->matter('sidebar_order') ?? null;
            $section = $document->matter('sidebar_section') ?? null;
        }

        $items[] = [
            'type' => 'folder',
            'title' => ucfirst(str_replace('-', ' ', $folderName)),
            'link' => File::exists($indexPath) ? route('docs.show', ['slug' => ltrim($relativeUrl, '/')]) : null,
            'children' => buildSidebarTree($dir, $relativeUrl, $routePrefix),
            'order' => $order,
            'section' => $section,
        ];
    }

    foreach ($files as $file) {
        $fileName = pathinfo($file, PATHINFO_FILENAME);

        if ($fileName === 'index') {
            continue;
        }

        $document = YamlFrontMatter::parse(File::get($file));

        if ($document->matter('sidebar') === false) {
            continue;
        }

        $relativeUrl = $baseUrl.'/'.$fileName;

        $items[] = [
            'type' => 'file',
            'title' => $document->matter('title') ?? ucfirst(str_replace('-', ' ', $fileName)),
            'link' => route('docs.show', ['slug' => ltrim($relativeUrl, '/')]),
            'order' => $document->matter('sidebar_order') ?? null,
            'section' => $document->matter('sidebar_section') ?? null,
        ];
    }

    usort($items, function ($a, $b) {
        if ($a['order'] === $b['order']) {
            return strcmp($a['title'], $b['title']);
        }

        return ($a['order'] ?? PHP_INT_MAX) <=> ($b['order'] ?? PHP_INT_MAX);
    });

    return $items;
}
