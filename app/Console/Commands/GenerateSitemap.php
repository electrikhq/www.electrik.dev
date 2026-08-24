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

        $paths = require base_path('app/Helpers/get_export_paths.php');

        $sitemap = Sitemap::create();
        $count = 0;

        foreach ($paths as $path) {
            $normalized = trim((string) $path, '/');

            if (str_ends_with($normalized, '.md')) {
                continue;
            }

            if ($normalized === 'docs/index') {
                continue;
            }

            $loc = function_exists('siteSitemapLoc')
                ? siteSitemapLoc($base, $normalized)
                : ($normalized === '' ? $base.'/' : $base.'/'.$normalized.'/');

            $sitemap->add(
                Url::create($loc)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority($normalized === '' ? 1.0 : (str_starts_with($normalized, 'docs') ? 0.9 : 0.8))
            );
            $count++;
        }

        $destination = base_path('dist/sitemap.xml');
        if (! is_dir(dirname($destination))) {
            mkdir(dirname($destination), 0755, true);
        }

        $sitemap->writeToFile($destination);

        $this->info("Sitemap written to dist/sitemap.xml ({$count} URLs)");

        return self::SUCCESS;
    }
}
