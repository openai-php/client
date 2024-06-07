<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores;

final class VectorStoreListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
                'object' => 'vector_store',
                'name' => 'Product Knowledge Base',
                'status' => 'completed',
                'usage_bytes' => 29882,
                'created_at' => 1_715_953_317,
                'file_counts' => [
                    'in_progress' => 0,
                    'completed' => 1,
                    'failed' => 0,
                    'cancelled' => 0,
                    'total' => 1,
                ],
                'metadata' => [],
                'expires_after' => null,
                'expires_at' => null,
                'last_active_at' => 1_715_953_317,
            ],
            [
                'id' => 'vs_xzlnkCbIQE50B9A8RzmcFmtP',
                'object' => 'vector_store',
                'name' => null,
                'status' => 'completed',
                'usage_bytes' => 0,
                'created_at' => 1_710_869_420,
                'file_counts' => [
                    'in_progress' => 0,
                    'completed' => 1,
                    'failed' => 0,
                    'cancelled' => 0,
                    'total' => 1,
                ],
                'metadata' => [],
                'expires_after' => null,
                'expires_at' => null,
                'last_active_at' => 1_710_869_420,
            ],
        ],
        'first_id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
        'last_id' => 'vs_xzlnkCbIQE50B9A8RzmcFmtP',
        'has_more' => true,
    ];
}
