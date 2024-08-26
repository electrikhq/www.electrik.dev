<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\YamlFrontMatter\YamlFrontMatter;

function flattenSidebar($items, $baseSlug = '') {
    $flattened = [];

    foreach ($items as $item) {
        if ($item['type'] === 'file') {
            $flattened[] = [
                'title' => $item['title'],
                'slug' => $baseSlug . '/' . pathinfo($item['link'], PATHINFO_FILENAME),
                'link' => $item['link'],
            ];
        } elseif ($item['type'] === 'folder') {
            $flattened = array_merge($flattened, flattenSidebar($item['children'], $baseSlug . '/' . basename($item['link'])));
        }
    }

    return $flattened;
}

Route::get('docs/{project}/{version}/{slug?}', function ($project, $version, $slug = null) {
    if (!$slug) $slug = 'index';

    $availableVersions = collect(File::directories(resource_path("content/docs/{$project}")))
        ->map(function ($path) {
            return basename($path);
        });

    $sidebar = generateSidebar($project, $version);
    $flatSidebar = flattenSidebar($sidebar);

    $currentIndex = collect($flatSidebar)->search(function ($item) use ($slug) {
        return $item['slug'] === '/' . $slug;
    });

    $nextPage = $flatSidebar[$currentIndex + 1] ?? null;
    $previousPage = $flatSidebar[$currentIndex - 1] ?? null;

    
    $filePath = resource_path("content/docs/{$project}/{$version}/{$slug}.md");
    $file = File::get($filePath);

    // Parse the Markdown file with front matter
    $document = YamlFrontMatter::parse($file);

    $title = $document->matter('title');
    $description = $document->matter('description');
    $markdown = $document->body();

    // Convert Markdown to HTML first
    $htmlContent = app(MarkdownRenderer::class)->convertToHtml($markdown);

    // Render any Blade components within the converted Markdown
    $renderedContent = Blade::render($htmlContent->getContent());

    // Generate Table of Contents from the rendered content
    $parsedContent = generateTableOfContents($renderedContent);
    $headings = $parsedContent['headings'];


    // Get the last modified time of the file
    $lastModified = File::lastModified($filePath);
    $lastModifiedDate = \Carbon\Carbon::createFromTimestamp($lastModified);


    // Return the rendered HTML to the view
    return view('layouts.documentation', [
        'slug' => $slug,
        'html' => $renderedContent,
        'headings' => $headings,
        'version' => $version,
        'availableVersions' => $availableVersions,
        'project' => $project,
        'sidebar' => $sidebar,
        'title' => $title,
        'description' => $description,
        'nextPage' => $nextPage,
        'previousPage' => $previousPage,
        'lastModifiedDate' => $lastModifiedDate,

    ]);
})->where('slug', '.*')->name('docs.show');

Route::get('{slug?}', function ($slug = null) {
    if (!$slug) $slug = 'index';

    View::addLocation(resource_path('content/www'));

    return view($slug);

})->where('slug', '.*')->name('www.show');


Route::get('/demo/slate/dashboard', function () {
    return view('demo.slate.dashboard');
});
Route::get('/demo/slate/{slug}', function ($slug) {
    return view('demo.slate.'.$slug);
});
