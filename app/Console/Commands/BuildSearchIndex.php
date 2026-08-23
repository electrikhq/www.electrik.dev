<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class BuildSearchIndex extends Command
{
    protected $signature = 'search:build {--path= : Output path relative to public/}';

    protected $description = 'Build the static MiniSearch index from Electrik docs markdown';

    public function handle(): int
    {
        $relative = $this->option('path') ?: 'search-index.json';
        $output = public_path($relative);

        $documents = array_merge(
            $this->collectFromDirectory(resource_path('content/docs'), 'docs', 'Docs'),
            $this->collectMarketingPages(),
        );

        File::ensureDirectoryExists(dirname($output));
        File::put($output, json_encode([
            'generatedAt' => now()->toIso8601String(),
            'documents' => array_values($documents),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        $this->info(sprintf('Wrote %d documents to %s', count($documents), $output));

        return self::SUCCESS;
    }

    /**
     * @return list<array{id: string, title: string, description: string, section: string, url: string, body: string}>
     */
    protected function collectFromDirectory(string $directory, string $urlPrefix, string $section): array
    {
        if (! File::isDirectory($directory)) {
            return [];
        }

        $documents = [];

        foreach (File::allFiles($directory) as $file) {
            if ($file->getExtension() !== 'md') {
                continue;
            }

            $relative = str_replace('\\', '/', $file->getRelativePathname());
            $slug = preg_replace('/\.md$/', '', $relative);
            $parsed = $this->parseMarkdownFile($file->getPathname());

            if ($parsed === null) {
                continue;
            }

            $sectionLabel = (string) (YamlFrontMatter::parse(File::get($file->getPathname()))->matter('sidebar_section') ?: $section);
            $url = '/'.$urlPrefix.'/'.$slug;

            $documents[] = [
                'id' => $urlPrefix.':'.$slug,
                'title' => $parsed['title'],
                'description' => $parsed['description'],
                'section' => $sectionLabel,
                'url' => $url,
                'body' => $parsed['body'],
            ];
        }

        return $documents;
    }

    /**
     * @return list<array{id: string, title: string, description: string, section: string, url: string, body: string}>
     */
    protected function collectMarketingPages(): array
    {
        return [
            [
                'id' => 'install',
                'title' => 'Install',
                'description' => 'Quickstart install for Electrik 5.x',
                'section' => 'Marketing',
                'url' => '/install',
                'body' => 'composer require electrik electrik:install stripe seed-demo',
            ],
            [
                'id' => 'license',
                'title' => 'License',
                'description' => 'BSL 1.1 Additional Use Grant and commercial licensing',
                'section' => 'Marketing',
                'url' => '/license',
                'body' => 'business source license commercial indie pre-revenue',
            ],
            [
                'id' => 'pricing',
                'title' => 'Pricing',
                'description' => 'Commercial license tiers',
                'section' => 'Marketing',
                'url' => '/pricing',
                'body' => 'solo studio agency commercial license',
            ],
            [
                'id' => 'faq',
                'title' => 'FAQ',
                'description' => 'Frequently asked questions about Electrik',
                'section' => 'Marketing',
                'url' => '/faq',
                'body' => 'free install slate billing teams',
            ],
        ];
    }

    /**
     * @return array{title: string, description: string, body: string}|null
     */
    protected function parseMarkdownFile(string $path): ?array
    {
        $raw = File::get($path);
        $document = YamlFrontMatter::parse($raw);

        if ($document->matter('sidebar') === false) {
            return null;
        }

        $title = (string) ($document->matter('title') ?? '');
        $description = (string) ($document->matter('description') ?? '');
        $body = $this->plainText($document->body());

        if ($title === '' && $body === '') {
            return null;
        }

        if ($title === '') {
            $title = str($path)->basename('.md')->replace('-', ' ')->title()->toString();
        }

        return [
            'title' => $title,
            'description' => $description,
            'body' => $body,
        ];
    }

    protected function plainText(string $markdown): string
    {
        $text = $markdown;
        $text = preg_replace('/```[\s\S]*?```/', ' ', $text) ?? $text;
        $text = preg_replace('/<\/?x-[^>]+>/', ' ', $text) ?? $text;
        $text = preg_replace('/<[^>]+>/', ' ', $text) ?? $text;
        $text = preg_replace('/[#>*_`\[\]\(\)!|-]/', ' ', $text) ?? $text;
        $text = preg_replace('/\s+/', ' ', $text) ?? $text;

        return trim(mb_substr($text, 0, 5000));
    }
}
