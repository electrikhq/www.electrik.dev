<?php

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Str;

class Seo
{
    public const SITE_NAME = 'Electrik';

    public const SITE_TAGLINE = 'Laravel SaaS starter kit';

    public const DEFAULT_DESCRIPTION = 'Auth, teams, and Stripe billing as a Composer package on Laravel 12, Livewire, and Slate 3. Full features in source with honest BSL dual licensing.';

    public const ORG_NAME = 'Electrik';

    public const ORG_URL = 'https://electrik.dev';

    public const GITHUB_URL = 'https://github.com/electrikhq/electrik';

    public const PACKAGIST_URL = 'https://packagist.org/packages/electrik/electrik';

    public const SLATE_URL = 'https://slate.electrik.dev';

    public const TWITTER_HANDLE = '@electrikhq';

    public static function baseUrl(): string
    {
        return siteCanonicalBaseUrl() ?: self::ORG_URL;
    }

    public static function absoluteUrl(?string $path = null): string
    {
        return siteCanonicalUrl($path);
    }

    public static function defaultImageUrl(): string
    {
        return self::absoluteUrl('/images/og-default.png');
    }

    public static function logoUrl(): string
    {
        return self::absoluteUrl('/images/electrik-mark.png');
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    public static function meta(array $overrides = []): array
    {
        $siteName = config('site.name', self::SITE_NAME);
        $tagline = config('site.tagline', self::SITE_TAGLINE);

        $title = trim((string) ($overrides['title'] ?? $siteName));
        if ($title !== '' && ! str_contains($title, $siteName) && $title !== $siteName) {
            $documentTitle = $title.' · '.$siteName;
        } else {
            $documentTitle = $title !== '' ? $title : $siteName.' — '.$tagline;
        }

        $description = trim((string) ($overrides['description'] ?? self::DEFAULT_DESCRIPTION));
        if ($description === '') {
            $description = self::DEFAULT_DESCRIPTION;
        }

        $url = $overrides['url'] ?? self::absoluteUrl(request()->getPathInfo());
        $image = $overrides['image'] ?? self::defaultImageUrl();
        $type = $overrides['type'] ?? 'website';

        $keywords = $overrides['keywords'] ?? null;
        $keywordsString = null;
        if (is_array($keywords) && $keywords !== []) {
            $keywordsString = implode(', ', $keywords);
        }

        return [
            'title' => $documentTitle,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'type' => $type,
            'siteName' => $siteName,
            'locale' => 'en_US',
            'robots' => $overrides['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'twitterCard' => 'summary_large_image',
            'twitterSite' => self::TWITTER_HANDLE,
            'published' => null,
            'modified' => null,
            'section' => $overrides['section'] ?? null,
            'keywords' => $keywordsString,
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function organizationGraph(): array
    {
        return [
            [
                '@type' => 'Organization',
                '@id' => self::ORG_URL.'/#organization',
                'name' => self::ORG_NAME,
                'url' => self::ORG_URL,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => self::logoUrl(),
                ],
                'sameAs' => [
                    self::GITHUB_URL,
                    'https://github.com/electrikhq',
                    self::SLATE_URL,
                ],
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function websiteGraph(): array
    {
        $base = self::baseUrl();

        return [
            [
                '@type' => 'WebSite',
                '@id' => $base.'/#website',
                'url' => $base.'/',
                'name' => self::SITE_NAME,
                'description' => self::DEFAULT_DESCRIPTION,
                'publisher' => ['@id' => self::ORG_URL.'/#organization'],
                'inLanguage' => 'en-US',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function productHuntConfig(): array
    {
        return config('product-hunt', []);
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function productHuntAggregateRating(): ?array
    {
        $ph = self::productHuntConfig();
        $count = (int) ($ph['review_count'] ?? 0);
        if ($count < 1) {
            return null;
        }

        return [
            '@type' => 'AggregateRating',
            'ratingValue' => (string) ($ph['rating'] ?? '5'),
            'reviewCount' => (string) $count,
            'bestRating' => '5',
            'worstRating' => '1',
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function productHuntReviewGraph(): array
    {
        $ph = self::productHuntConfig();
        $review = $ph['review'] ?? [];
        if ($review === []) {
            return [];
        }

        $reviewsUrl = $ph['reviews_url'] ?? ($ph['url'] ?? null);
        $rating = (string) ($ph['rating'] ?? '5');
        $body = trim((string) ($review['body'] ?? ''));
        if (! empty($review['improve'])) {
            $body = trim($body."\n\nWhat needs improvement: ".$review['improve']);
        }

        $node = [
            '@type' => 'Review',
            '@id' => self::baseUrl().'/#product-hunt-review',
            'itemReviewed' => ['@id' => self::baseUrl().'/#software'],
            'author' => [
                '@type' => 'Person',
                'name' => $review['author'] ?? 'Founder',
            ],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $rating,
                'bestRating' => '5',
                'worstRating' => '1',
            ],
            'reviewBody' => $body,
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Product Hunt',
                'url' => 'https://www.producthunt.com',
            ],
        ];

        if (is_string($reviewsUrl) && $reviewsUrl !== '') {
            $node['url'] = $reviewsUrl;
        }

        return [$node];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function softwareApplicationGraph(): array
    {
        $sameAs = [
            self::GITHUB_URL,
            self::PACKAGIST_URL,
            self::SLATE_URL,
        ];

        $productHuntUrl = self::productHuntProductUrl();
        if ($productHuntUrl !== null) {
            $sameAs[] = $productHuntUrl;
        }

        $application = [
            '@type' => 'SoftwareApplication',
            '@id' => self::baseUrl().'/#software',
            'name' => self::SITE_NAME,
            'applicationCategory' => 'DeveloperApplication',
            'operatingSystem' => 'Cross-platform',
            'description' => self::DEFAULT_DESCRIPTION,
            'url' => self::baseUrl().'/',
            'downloadUrl' => self::PACKAGIST_URL,
            'installUrl' => self::absoluteUrl('/install'),
            'softwareVersion' => config('site.version', '5.0.0'),
            'license' => self::absoluteUrl('/license'),
            'author' => ['@id' => self::ORG_URL.'/#organization'],
            'offers' => [
                [
                    '@type' => 'Offer',
                    'name' => 'Additional Use Grant',
                    'price' => '0',
                    'priceCurrency' => 'USD',
                    'description' => 'Personal, educational, open-source, and pre-revenue indie use.',
                ],
            ],
            'codeRepository' => self::GITHUB_URL,
            'programmingLanguage' => ['PHP', 'Blade', 'CSS', 'JavaScript'],
            'keywords' => 'Laravel, SaaS, Livewire, Stripe, teams, billing, Slate, starter kit',
            'sameAs' => array_values(array_unique($sameAs)),
        ];

        $aggregateRating = self::productHuntAggregateRating();
        if ($aggregateRating !== null) {
            $application['aggregateRating'] = $aggregateRating;
        }

        return [$application];
    }

    public static function productHuntProductUrl(): ?string
    {
        $url = self::productHuntConfig()['url'] ?? null;
        if (! is_string($url) || $url === '') {
            return null;
        }

        return strtok($url, '?') ?: null;
    }

    /**
     * @param  list<array{name: string, url: string}>  $crumbs
     * @return list<array<string, mixed>>
     */
    public static function breadcrumbGraph(array $crumbs): array
    {
        if ($crumbs === []) {
            return [];
        }

        $items = [];
        foreach (array_values($crumbs) as $index => $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['name'],
                'item' => $crumb['url'],
            ];
        }

        return [
            [
                '@type' => 'BreadcrumbList',
                '@id' => ($crumbs[array_key_last($crumbs)]['url'] ?? self::baseUrl()).'/#breadcrumb',
                'itemListElement' => $items,
            ],
        ];
    }

    /**
     * @param  list<array{question: string, answer: string}>  $faqs
     * @return list<array<string, mixed>>
     */
    public static function faqPageGraph(string $url, array $faqs): array
    {
        if ($faqs === []) {
            return [];
        }

        $entities = [];
        foreach ($faqs as $faq) {
            $entities[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ];
        }

        return [
            [
                '@type' => 'FAQPage',
                '@id' => $url.'#faq',
                'url' => $url,
                'mainEntity' => $entities,
            ],
        ];
    }

    /**
     * @param  list<array<string, mixed>>  ...$chunks
     * @return array{ '@context': string, '@graph': list<array<string, mixed>> }
     */
    public static function graph(array ...$chunks): array
    {
        $graph = [];
        foreach ($chunks as $chunk) {
            foreach ($chunk as $node) {
                $graph[] = $node;
            }
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    /**
     * @return list<array{question: string, answer: string}>
     */
    public static function homepageFaqs(): array
    {
        return [
            [
                'question' => 'Is Electrik free?',
                'answer' => 'Electrik includes a free Additional Use Grant for personal, educational, open-source, and pre-revenue indie use. Companies, client work, and commercial products require a commercial license. All features ship in source for both lanes.',
            ],
            [
                'question' => 'How do I install Electrik 5.x?',
                'answer' => 'Require the package with Composer, then run php artisan electrik:install on a fresh Laravel 12 app. See the install guide on electrik.dev for requirements and Stripe setup.',
            ],
            [
                'question' => 'What UI stack does Electrik use?',
                'answer' => 'Electrik 5.x is built on Electrik Slate 3: anonymous Blade components, Tailwind CSS v4 tokens, and Livewire 4. UI documentation lives at slate.electrik.dev.',
            ],
        ];
    }

    public static function plainAnswer(string $text): string
    {
        return Str::limit(strip_tags($text), 5000, '');
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function techArticleGraph(
        string $headline,
        string $description,
        string $url,
        ?CarbonInterface $dateModified = null,
        ?string $section = null,
    ): array {
        $modified = ($dateModified ?? now())->toIso8601String();

        $article = [
            '@type' => 'TechArticle',
            '@id' => $url.'#article',
            'headline' => $headline,
            'description' => $description,
            'url' => $url,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $url,
            ],
            'datePublished' => $modified,
            'dateModified' => $modified,
            'inLanguage' => 'en-US',
            'isPartOf' => ['@id' => self::baseUrl().'/#website'],
            'author' => [
                '@type' => 'Organization',
                'name' => self::ORG_NAME,
            ],
            'publisher' => ['@id' => self::ORG_URL.'/#organization'],
        ];

        if ($section) {
            $article['articleSection'] = $section;
        }

        return [$article];
    }

    /**
     * @return list<array{name: string, url: string}>
     */
    public static function docsBreadcrumbs(string $section, string $slug, string $title): array
    {
        $crumbs = [
            ['name' => 'Home', 'url' => self::absoluteUrl('/')],
            ['name' => 'Docs', 'url' => self::absoluteUrl('/docs')],
        ];

        if ($slug !== 'index' && $slug !== 'getting-started/introduction') {
            $parts = array_values(array_filter(explode('/', $slug)));
            $accum = '';
            foreach ($parts as $i => $part) {
                $accum .= ($accum === '' ? '' : '/').$part;
                $isLast = $i === count($parts) - 1;
                $crumbs[] = [
                    'name' => $isLast ? $title : Str::of($part)->replace('-', ' ')->title()->toString(),
                    'url' => self::absoluteUrl('/docs/'.$accum),
                ];
            }
        } elseif ($slug === 'getting-started/introduction') {
            $crumbs[] = ['name' => $title, 'url' => self::absoluteUrl('/docs/getting-started/introduction')];
        }

        return $crumbs;
    }
}
