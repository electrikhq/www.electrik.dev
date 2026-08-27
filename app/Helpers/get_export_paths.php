<?php

// Included by config/export.php before full Laravel bootstrap — native PHP only.

$paths = [
    '/',
    'install',
    'license',
    'pricing',
    'pricing/thanks',
    'faq',
    'contact',
    'legal',
    'tools',
    'tools/tailwind-color-generator',
    'compare',
];

foreach (['privacy', 'terms', 'cookies', 'trademark', 'dmca'] as $legalSlug) {
    $paths[] = 'legal/'.$legalSlug;
}

foreach (['jetstream', 'spark', 'wave', 'saasykit', 'larafast', 'filament'] as $compareSlug) {
    $paths[] = 'compare/electrik-vs-'.$compareSlug;
}

$docsPath = __DIR__.'/../../resources/content/docs';

if (is_dir($docsPath)) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($docsPath, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'md') {
            $relativePath = str_replace($docsPath.'/', '', $file->getPathname());
            $slug = str_replace('.md', '', $relativePath);
            $paths[] = 'docs/'.$slug;
            $paths[] = 'docs/'.$slug.'.md';
        }
    }
}

return array_values(array_unique($paths));
