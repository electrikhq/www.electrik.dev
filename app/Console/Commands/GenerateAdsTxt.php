<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateAdsTxt extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'generate:ads:txt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the ads.txt';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        
        // Generate the sitemap with localhost URLs and then modify them to point to the live site
        
        File::put(base_path('dist/ads.txt'), 'google.com, pub-4533175894495099, DIRECT, f08c47fec0942fa0');

        $this->info('Ads.txt generated successfully');
    }
}
