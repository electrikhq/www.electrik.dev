<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap.xml with production URLs';

    public function handle(): int
    {
        $base = rtrim((string) (env('APP_PRODUCTION_URL') ?: config('app.url')), '/');

        $paths = [
            '/',
            '/install',
            '/license',
            '/pricing',
            '/faq',
            '/contact',
        ];

        $sitemap = Sitemap::create();

        foreach ($paths as $path) {
            $sitemap->add(
                Url::create($base.$path)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority($path === '/' ? 1.0 : 0.8)
            );
        }

        $destination = base_path('dist/sitemap.xml');
        if (! is_dir(dirname($destination))) {
            mkdir(dirname($destination), 0755, true);
        }

        $sitemap->writeToFile($destination);

        $this->info('Sitemap written to dist/sitemap.xml');

        return self::SUCCESS;
    }
}
