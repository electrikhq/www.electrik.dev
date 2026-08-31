<?php

namespace Tests\Feature;

use Tests\TestCase;

class MarketingPagesTest extends TestCase
{
    /** @dataProvider publicPages */
    public function test_public_pages_render(string $path): void
    {
        $this->get($path)->assertOk();
    }

    public static function publicPages(): array
    {
        return [
            ['/'],
            ['/install'],
            ['/license'],
            ['/pricing'],
            ['/faq'],
            ['/contact'],
        ];
    }

    public function test_docs_hub_redirects_to_introduction(): void
    {
        $this->get('/docs')->assertRedirect('/docs/getting-started/introduction');
    }

    public function test_slate_docs_redirect_to_slate_site(): void
    {
        $this->get('/docs/slate/components/button')->assertRedirect('https://slate.electrik.dev');
    }
}
