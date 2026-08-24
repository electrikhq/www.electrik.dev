<?php

return [

    'site_name' => 'electrik.dev',

    'operator' => 'Neeraj Kumar',

    'contact_email' => env('LEGAL_CONTACT_EMAIL', 'hello@electrik.dev'),

    'sections' => [
        [
            'title' => 'Website',
            'description' => 'Policies that govern use of electrik.dev and related marketing pages.',
            'documents' => [
                ['slug' => 'privacy', 'title' => 'Privacy Policy'],
                ['slug' => 'terms', 'title' => 'Terms of Service'],
                ['slug' => 'cookies', 'title' => 'Cookie Policy'],
                ['slug' => 'trademark', 'title' => 'Trademark Policy'],
                ['slug' => 'dmca', 'title' => 'DMCA Copyright Policy'],
            ],
        ],
        [
            'title' => 'Product',
            'description' => 'Software licensing for the Electrik Laravel starter kit.',
            'documents' => [
                [
                    'title' => 'Software License (BSL 1.1)',
                    'path' => '/license',
                ],
                [
                    'title' => 'Commercial licensing',
                    'path' => '/pricing',
                ],
            ],
        ],
    ],

];
