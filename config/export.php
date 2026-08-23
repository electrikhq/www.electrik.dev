<?php

return [

    /*
     * Explicit path list — broken crawl links must not block deploys.
     */
    'crawl' => false,

    /*
     * Marketing pages + all markdown docs (see get_export_paths.php).
     */
    'paths' => require __DIR__.'/../app/Helpers/get_export_paths.php',

    /*
     * Files and folders that should be included in the build. Expects
     * key/value pairs with current paths as keys, and destination paths
     * as values.
     *
     * By default your `public` folder's contents will be added to the export.
     */
    'include_files' => [
        'public' => '',
    ],

    /*
     * File patterns that should be excluded from the included files.
     */
    'exclude_file_patterns' => [
        '/\.php$/',
        '/mix-manifest\.json$/',
    ],

    /*
     * Whether or not the destination folder should be emptied before starting
     * the export.
     */
    'clean_before_export' => true,

    /*
     * If set, the site will be exported to this disk. Disks can be configured
     * in `config/filesystems.php`.
     *
     * If empty, your site will be exported to a `dist` folder.
     */
    'disk' => null,

    /*
     * Shell commands that should be run before the export starts when running
     * `php artisan export`.
     *
     * You can skip these by adding a `--skip-{name}` flag to the command.
     */
    'before' => [
        'search' => 'php artisan search:build',
        'llms' => 'php artisan llms:build',
    ],

    /*
     * Shell commands that should be run after the export has finished when
     * running `php artisan export`.
     *
     * You can skip these by adding a `--skip-{name}` flag to the command.
     */
    'after' => [
        'fix-urls' => 'php artisan export:fix-urls',
        'sitemap:generate' => 'php artisan sitemap:generate',
        'generate:ads:txt' => 'php artisan generate:ads:txt',
        'generate:funding:json' => 'php artisan generate:funding:json',
    ],

];
