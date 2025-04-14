<?php

/**
 * @return array<string, mixed>
 */
function vectorStoreSearchResource(): array
{
    return [
        'object' => 'vector_store.search_results.page',
        'search_query' => 'What is the return policy?',
        'data' => [
            [
                'file_id' => 'file_abc123',
                'filename' => 'policy.pdf',
                'score' => 0.95,
                'attributes' => [
                    'author' => 'John Doe',
                    'date' => '2023-01-01',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Our return policy allows for returns within 30 days of purchase.',
                    ],
                ],
            ],
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
