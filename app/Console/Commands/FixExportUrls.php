<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixExportUrls extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'export:fix-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix absolute URLs in exported HTML files to use relative paths';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $distPath = base_path('dist');

        if (! File::exists($distPath)) {
            $this->error('Dist directory not found. Run export first.');

            return 1;
        }

        // Get the local URL that was used during export
        $localUrl = env('APP_LOCAL_URL') ?? env('APP_URL') ?? 'http://127.0.0.1:8000';
        // Remove trailing slash for consistency
        $localUrl = rtrim($localUrl, '/');

        // Parse the URL to extract protocol and host
        $parsedUrl = parse_url($localUrl);
        $localHost = ($parsedUrl['scheme'] ?? 'http').'://'.($parsedUrl['host'] ?? '127.0.0.1').(isset($parsedUrl['port']) ? ':'.$parsedUrl['port'] : '');

        $productionUrl = rtrim((string) (env('APP_PRODUCTION_URL') ?: 'https://electrik.dev'), '/');

        $this->info("Replacing URLs matching: {$localHost}");
        $this->info("Production URL for encoded AI prompts: {$productionUrl}");

        $htmlFiles = File::allFiles($distPath);
        $fixedCount = 0;

        $localHosts = array_values(array_unique([
            $localHost,
            'http://127.0.0.1:8000',
            'https://127.0.0.1:8000',
            'http://localhost:8000',
            'https://localhost:8000',
            'http://localhost',
            'https://localhost',
        ]));

        foreach ($htmlFiles as $file) {
            if ($file->getExtension() !== 'html') {
                continue;
            }

            $content = File::get($file->getPathname());
            $originalContent = $content;

            // URL-encoded local hosts inside AI prompt query strings must become
            // the production host (relative paths are wrong inside those prompts).
            foreach ($localHosts as $host) {
                $content = str_replace(rawurlencode($host), rawurlencode($productionUrl), $content);
                $content = str_replace(urlencode($host), urlencode($productionUrl), $content);
            }

            // Replace absolute URLs with relative paths
            // Handle URLs in href attributes
            $content = preg_replace('/href="'.preg_quote($localHost, '/').'\/build\//', 'href="/build/', $content);
            $content = preg_replace('/href="'.preg_quote($localHost, '/').'"/', 'href="/"', $content);
            $content = preg_replace('/href="'.preg_quote($localHost, '/').'\//', 'href="/', $content);

            // Handle URLs in src attributes
            $content = preg_replace('/src="'.preg_quote($localHost, '/').'\/build\//', 'src="/build/', $content);
            $content = preg_replace('/src="'.preg_quote($localHost, '/').'"/', 'src="/"', $content);
            $content = preg_replace('/src="'.preg_quote($localHost, '/').'\//', 'src="/', $content);

            // Handle URLs in content attributes (meta tags)
            $content = preg_replace('/content="'.preg_quote($localHost, '/').'"/', 'content="/"', $content);
            $content = preg_replace('/content="'.preg_quote($localHost, '/').'\//', 'content="/', $content);

            // Handle URLs in any attribute (catch-all regex)
            $content = preg_replace('/="'.preg_quote($localHost, '/').'\/build\//', '="/build/', $content);
            $content = preg_replace('/="'.preg_quote($localHost, '/').'"/', '="/"', $content);
            $content = preg_replace('/="'.preg_quote($localHost, '/').'\//', '="/', $content);

            // Handle any remaining localhost/127.0.0.1 URLs (catch-all string replacement)
            $content = str_replace($localHost.'/build/', '/build/', $content);
            $content = str_replace($localHost.'/', '/', $content);
            $content = str_replace($localHost, '/', $content);

            // Also handle common localhost patterns as fallback
            $content = str_replace('http://localhost/build/', '/build/', $content);
            $content = str_replace('http://localhost/', '/', $content);
            $content = str_replace('https://localhost/build/', '/build/', $content);
            $content = str_replace('https://localhost/', '/', $content);
            $content = str_replace('http://127.0.0.1:8000/build/', '/build/', $content);
            $content = str_replace('http://127.0.0.1:8000/', '/', $content);
            $content = str_replace('https://127.0.0.1:8000/build/', '/build/', $content);
            $content = str_replace('https://127.0.0.1:8000/', '/', $content);

            // Only write if content changed
            if ($content !== $originalContent) {
                File::put($file->getPathname(), $content);
                $fixedCount++;
            }
        }

        $this->info("Fixed URLs in {$fixedCount} HTML file(s).");

        return 0;
    }
}
