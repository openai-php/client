<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores;

final class VectorStoreResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
        'object' => 'vector_store',
        'name' => 'Product Knowledge Base',
        'status' => 'in_progress',
        'usage_bytes' => 0,
        'created_at' => 1_715_953_317,
        'file_counts' => [
            'in_progress' => 1,
            'completed' => 0,
            'failed' => 0,
            'cancelled' => 0,
            'total' => 1,
        ],
        'metadata' => [],
        'expires_after' => null,
        'expires_at' => null,
        'last_active_at' => 1_715_953_317,
    ];
}
