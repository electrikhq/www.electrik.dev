<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class BuildLlmsTxt extends Command
{
    protected $signature = 'llms:build';

    protected $description = 'Build public/llms.txt and public/llms-full.txt for AI agents';

    public function handle(): int
    {
        $base = rtrim((string) (env('APP_PRODUCTION_URL') ?: 'https://electrik.dev'), '/');

        File::put(public_path('llms.txt'), $this->buildIndex($base));
        File::put(public_path('llms-full.txt'), $this->buildFull($base));

        $this->info('Wrote public/llms.txt and public/llms-full.txt');

        return self::SUCCESS;
    }

    protected function buildIndex(string $base): string
    {
        $lines = [
            '# Electrik',
            '',
            '> Electrik is a Laravel SaaS starter kit: authentication, teams, and Stripe billing as a Composer package (`electrik/electrik` 5.x). Built on Electrik Slate 3. Docs: '.$base.'/docs',
            '',
            '## Get started',
            '',
            '- [Introduction]('.$base.'/docs/getting-started/introduction): What Electrik 5.x is.',
            '- [Quickstart]('.$base.'/docs/getting-started/quickstart): Fastest path to a running app.',
            '- [Installation]('.$base.'/docs/getting-started/installation): `electrik:install` deep dive.',
            '- [Architecture]('.$base.'/docs/getting-started/architecture): Package vs App, teams as tenant.',
            '- [Install page]('.$base.'/install): Marketing quickstart.',
            '',
            '## Core concepts',
            '',
        ];

        foreach ($this->docsInSection('Core Concepts') as $entry) {
            $lines[] = sprintf(
                '- [%s](%s/docs/%s): %s',
                $entry['title'],
                $base,
                $entry['slug'],
                $entry['description'] !== '' ? $entry['description'] : 'Electrik docs.'
            );
        }

        $lines[] = '';
        $lines[] = '## Guides & reference';
        $lines[] = '';

        foreach (array_merge(
            $this->docsInSection('Guides'),
            $this->docsInSection('Reference'),
            $this->docsInSection('License & commercial'),
            $this->docsInSection('Ecosystem'),
        ) as $entry) {
            $lines[] = sprintf(
                '- [%s](%s/docs/%s): %s',
                $entry['title'],
                $base,
                $entry['slug'],
                $entry['description'] !== '' ? $entry['description'] : 'Electrik docs.'
            );
        }

        $lines[] = '';
        $lines[] = '## Related';
        $lines[] = '';
        $lines[] = '- [Slate UI docs](https://slate.electrik.dev): Blade components and tokens (do not re-host here).';
        $lines[] = '- [License]('.$base.'/license): BSL Additional Use Grant.';
        $lines[] = '- [Pricing]('.$base.'/pricing): Commercial tiers.';
        $lines[] = '- [GitHub](https://github.com/electrikhq/electrik)';
        $lines[] = '';
        $lines[] = '## Machine-readable';
        $lines[] = '';
        $lines[] = '- [llms.txt]('.$base.'/llms.txt): This index.';
        $lines[] = '- [llms-full.txt]('.$base.'/llms-full.txt): Index plus concatenated markdown docs.';
        $lines[] = '- Prefer `.md` URLs under `/docs/...md` when pasting into models.';
        $lines[] = '';

        return implode("\n", $lines);
    }

    protected function buildFull(string $base): string
    {
        $parts = [
            $this->buildIndex($base),
            '',
            '---',
            '',
            '# Full documentation dump',
            '',
            'Below is concatenated markdown from the docs site. Prefer individual `.md` URLs when possible.',
            '',
        ];

        foreach ($this->allMarkdownFiles() as $file) {
            $parts[] = '---';
            $parts[] = '';
            $parts[] = 'Source: '.$base.$file['url'];
            $parts[] = '';
            $parts[] = File::get($file['path']);
            $parts[] = '';
        }

        return implode("\n", $parts);
    }

    /**
     * @return list<array{slug: string, title: string, description: string}>
     */
    protected function docsInSection(string $section): array
    {
        $entries = [];

        foreach ($this->allMarkdownFiles() as $file) {
            $document = YamlFrontMatter::parse(File::get($file['path']));
            if ((string) $document->matter('sidebar_section') !== $section) {
                continue;
            }

            $entries[] = [
                'slug' => $file['slug'],
                'title' => (string) ($document->matter('title') ?: $file['slug']),
                'description' => (string) ($document->matter('description') ?: ''),
                'order' => $document->matter('sidebar_order') ?? PHP_INT_MAX,
            ];
        }

        usort($entries, fn ($a, $b) => ($a['order'] <=> $b['order']) ?: strcasecmp($a['title'], $b['title']));

        return $entries;
    }

    /**
     * @return list<array{path: string, url: string, slug: string}>
     */
    protected function allMarkdownFiles(): array
    {
        $directory = resource_path('content/docs');
        if (! File::isDirectory($directory)) {
            return [];
        }

        $files = [];

        foreach (File::allFiles($directory) as $file) {
            if ($file->getExtension() !== 'md') {
                continue;
            }

            $slug = str_replace('\\', '/', preg_replace('/\.md$/', '', $file->getRelativePathname()));
            $files[] = [
                'path' => $file->getPathname(),
                'url' => '/docs/'.$slug.'.md',
                'slug' => $slug,
            ];
        }

        usort($files, fn ($a, $b) => strcmp($a['slug'], $b['slug']));

        return $files;
    }
}
