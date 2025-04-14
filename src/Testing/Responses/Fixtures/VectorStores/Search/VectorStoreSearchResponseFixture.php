<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores\Search;

final class VectorStoreSearchResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'vector_store.search_results.page',
        'search_query' => 'What is the return policy?',
        'data' => [
            VectorStoreSearchResponseFileFixture::ATTRIBUTES,
            [
                'file_id' => 'file_xyz789',
                'filename' => 'notes.txt',
                'score' => 0.89,
                'attributes' => [
                    'author' => 'Jane Smith',
                    'date' => '2023-01-02',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Sample text content from the vector store.',
                    ],
                ],
            ],
        ],
        'has_more' => false,
        'next_page' => null,
    ];
}
