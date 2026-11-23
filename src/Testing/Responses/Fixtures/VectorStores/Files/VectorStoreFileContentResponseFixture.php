<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores\Files;

final class VectorStoreFileContentResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'vector_store.file_content.page',
        'data' => [
            [
                'type' => 'text',
                'text' => 'Annual plans have a 14-day refund window.',
            ],
        ],
        'has_more' => false,
        'next_page' => null,
    ];
}
