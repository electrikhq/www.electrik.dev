<?php

use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('newsletter.subscribe');

function flattenSidebar(array $items, string $baseSlug = ''): array
{
    $flattened = [];

    foreach ($items as $item) {
        if ($item['type'] === 'section') {
            $flattened = array_merge($flattened, flattenSidebar($item['children'] ?? [], $baseSlug));
            continue;
        }

        if ($item['type'] === 'file') {
            $flattened[] = [
                'title' => $item['title'],
                'slug' => parse_url($item['link'], PHP_URL_PATH),
                'link' => $item['link'],
            ];
        } elseif ($item['type'] === 'folder') {
            $folderName = '';
            if (! empty($item['link'])) {
                $folderName = basename(parse_url($item['link'], PHP_URL_PATH));
            } else {
                $folderName = strtolower(str_replace(' ', '-', $item['title']));
            }
            $flattened = array_merge($flattened, flattenSidebar($item['children'], $baseSlug.'/'.$folderName));
        }
    }

    return $flattened;
}

function renderDocumentationPage(string $filePath, string $slug, array $sidebar, ?array $nextPage, ?array $previousPage): \Illuminate\View\View
{
    $file = File::get($filePath);

    $document = YamlFrontMatter::parse($file);

    $title = $document->matter('title');
    $description = $document->matter('description');
    $markdown = $document->body();

    $htmlContent = app(MarkdownRenderer::class)->convertToHtml($markdown);
    $html = $htmlContent->getContent();
    $html = escapeBladeInDocumentationHtml($html);

    $renderedContent = Blade::render($html);

    $parsedContent = generateTableOfContents($renderedContent);
    $headings = $parsedContent['headings'];

    $lastModified = File::lastModified($filePath);
    $lastModifiedDate = \Carbon\Carbon::createFromTimestamp($lastModified);

    $pagePath = '/'.ltrim(request()->path(), '/');
    if ($pagePath === '//') {
        $pagePath = '/';
    }
    $pageUrl = docsCanonicalUrl($pagePath === '/' ? '/' : $pagePath);
    $markdownUrl = docsCanonicalUrl(rtrim($pagePath, '/').'.md');

    $pageTitle = $title ?: Str::of($slug)->replace('-', ' ')->title()->toString();
    $breadcrumbs = \App\Support\Seo::docsBreadcrumbs('docs', $slug, $pageTitle);

    $jsonLdChunks = [
        \App\Support\Seo::organizationGraph(),
        \App\Support\Seo::websiteGraph(),
        \App\Support\Seo::breadcrumbGraph($breadcrumbs),
        \App\Support\Seo::techArticleGraph(
            $pageTitle,
            $description ?: \App\Support\Seo::DEFAULT_DESCRIPTION,
            $pageUrl,
            $lastModifiedDate,
            'Documentation',
        ),
    ];

    return view('layouts.documentation', [
        'slug' => $slug,
        'html' => $renderedContent,
        'headings' => $headings,
        'sidebar' => $sidebar,
        'title' => $title,
        'description' => $description,
        'nextPage' => $nextPage,
        'previousPage' => $previousPage,
        'lastModifiedDate' => $lastModifiedDate,
        'pageMarkdown' => $markdown,
        'pageUrl' => $pageUrl,
        'markdownUrl' => $markdownUrl,
        'seoSection' => 'docs',
        'breadcrumbs' => $breadcrumbs,
        'seoGraph' => \App\Support\Seo::graph(...$jsonLdChunks),
    ]);
}

Route::redirect('docs/slate/{any?}', 'https://slate.electrik.dev')->where('any', '.*');
Route::redirect('demo/slate/{any?}', 'https://slate.electrik.dev')->where('any', '.*');
Route::redirect('about', '/');
Route::redirect('faqs', '/faq');

Route::get('/', fn () => view('pages.home'))->name('home');
Route::get('/install', fn () => view('pages.install'))->name('install');
Route::get('/license', fn () => view('pages.license'))->name('license');
Route::get('/pricing', fn () => view('pages.pricing'))->name('pricing');
Route::get('/faq', fn () => view('pages.faq'))->name('faq');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');

Route::get('/tools', fn () => view('pages.tools.index'))->name('tools.index');
Route::get('/tools/tailwind-color-generator', fn () => view('pages.tools.tailwind-color-generator'))
    ->name('tools.tailwind-color-generator');
Route::redirect('/tools/tailwindcss-color-scheme-generator', '/tools/tailwind-color-generator');

Route::get('/compare', fn () => view('pages.compare.index'))->name('compare.index');
Route::get('/compare/electrik-vs-{slug}', function (string $slug) {
    $competitor = \App\Support\Compare::find($slug);

    if ($competitor === null) {
        abort(404);
    }

    return view('pages.compare.show', ['competitor' => $competitor]);
})->whereIn('slug', \App\Support\Compare::slugs())->name('compare.show');

Route::get('/legal', fn () => view('pages.legal.index'))->name('legal.index');
Route::get('/legal/{slug}', function (string $slug) {
    if (! in_array($slug, legalDocumentSlugs(), true)) {
        abort(404);
    }

    return view('pages.legal.show', [
        'slug' => $slug,
        'document' => parseLegalDocument($slug),
        'siblings' => legalSiblingDocuments($slug),
    ]);
})->where('slug', '[a-z0-9-]+')->name('legal.show');

Route::get('docs/{slug}.md', function (string $slug) {
    $filePath = resource_path("content/docs/{$slug}.md");

    if (! File::exists($filePath)) {
        abort(404);
    }

    return response(File::get($filePath), 200, [
        'Content-Type' => 'text/markdown; charset=utf-8',
        'X-Robots-Tag' => 'noindex, follow',
    ]);
})->where('slug', '.*')->name('docs.markdown');

Route::get('docs/{slug?}', function ($slug = null) {
    if (! $slug) {
        $slug = 'getting-started/introduction';
    }

    $sidebar = generateSidebar();
    $flatSidebar = flattenSidebar($sidebar);

    $currentIndex = collect($flatSidebar)->search(function ($item) use ($slug) {
        return $item['slug'] === '/docs/'.$slug;
    });

    $nextPage = ($currentIndex !== false) ? ($flatSidebar[$currentIndex + 1] ?? null) : null;
    $previousPage = ($currentIndex !== false) ? ($flatSidebar[$currentIndex - 1] ?? null) : null;

    $filePath = resource_path("content/docs/{$slug}.md");

    if (! File::exists($filePath)) {
        abort(404);
    }

    return renderDocumentationPage($filePath, $slug, $sidebar, $nextPage, $previousPage);
})->where('slug', '.*')->name('docs.show');
