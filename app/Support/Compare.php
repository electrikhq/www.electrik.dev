<?php

namespace App\Support;

use InvalidArgumentException;

class Compare
{
    /**
     * @return list<string>
     */
    public static function slugs(): array
    {
        return array_keys(config('compare.competitors', []));
    }

    /**
     * @return array{slug: string, name: string, url: string, summary: string, stack_notes: string, pricing_blurb: string, cells: array<string, array{value: string, note: string}>}
     */
    public static function electrik(): array
    {
        return config('compare.electrik');
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return config('compare.competitors', []);
    }

    /**
     * @return array<string, mixed>
     */
    public static function find(string $slug): ?array
    {
        $competitors = self::all();

        if (! isset($competitors[$slug])) {
            return null;
        }

        return array_merge($competitors[$slug], ['slug' => $slug]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function findOrFail(string $slug): array
    {
        $competitor = self::find($slug);

        if ($competitor === null) {
            throw new InvalidArgumentException("Unknown compare slug [{$slug}].");
        }

        return $competitor;
    }

    /**
     * @return array<string, array{label: string, description: string}>
     */
    public static function featureRows(): array
    {
        return config('compare.features', []);
    }

    public static function disclaimer(): string
    {
        return (string) config('compare.disclaimer', '');
    }

    public static function pathFor(string $slug): string
    {
        return 'compare/electrik-vs-'.$slug;
    }

    public static function urlFor(string $slug): string
    {
        return siteCanonicalUrl('/'.self::pathFor($slug));
    }

    /**
     * @return list<array{slug: string, name: string, href: string}>
     */
    public static function related(string $exceptSlug, int $limit = 3): array
    {
        $items = [];

        foreach (self::all() as $slug => $competitor) {
            if ($slug === $exceptSlug) {
                continue;
            }

            $items[] = [
                'slug' => $slug,
                'name' => $competitor['name'],
                'href' => route('compare.show', $slug),
            ];

            if (count($items) >= $limit) {
                break;
            }
        }

        return $items;
    }

    public static function cellLabel(string $value): string
    {
        return match ($value) {
            'yes' => 'Yes',
            'no' => 'No',
            'partial' => 'Partial',
            'n/a' => 'n/a',
            default => $value,
        };
    }
}
