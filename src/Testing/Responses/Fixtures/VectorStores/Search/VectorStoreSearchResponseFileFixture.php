<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores\Search;

final class VectorStoreSearchResponseFileFixture
{
    public const ATTRIBUTES = [
        'file_id' => 'file_abc123',
        'filename' => 'document.pdf',
        'score' => 0.95,
        'attributes' => [
            'author' => 'John Doe',
            'date' => '2023-01-01',
        ],
        'content' => [
            VectorStoreSearchResponseContentFixture::ATTRIBUTES,
        ],
    ];
}
