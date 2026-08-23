<?php

function generateTableOfContents(string $html): array
{
    $dom = new DOMDocument;
    @$dom->loadHTML('<?xml encoding="utf-8" ?>'.$html);

    $headings = [];
    foreach (['h2', 'h3'] as $tag) {
        foreach ($dom->getElementsByTagName($tag) as $node) {
            $id = \Illuminate\Support\Str::slug($node->textContent);
            $headings[] = [
                'level' => $tag,
                'text' => $node->textContent,
                'id' => $id,
            ];
            $node->setAttribute('id', $id);
        }
    }

    return [
        'html' => $dom->saveHTML(),
        'headings' => $headings,
    ];
}
