<?php

/**
 * @return array<string, mixed>
 */
function vectorStoreResource(): array
{
    return [
        'id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
        'object' => 'vector_store',
        'name' => 'Product Knowledge Base',
        'status' => 'completed',
        'usage_bytes' => 29882,
        'created_at' => 1715953317,
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
        'last_active_at' => 1715953317,
    ];
}

/**
 * @return array<string, mixed>
 */
function vectorStoreWithExpiresAfterResource(): array
{
    return [
        'id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
        'object' => 'vector_store',
        'name' => 'Product Knowledge Base',
        'status' => 'completed',
        'usage_bytes' => 29882,
        'created_at' => 1715953317,
        'file_counts' => [
            'in_progress' => 0,
            'completed' => 1,
            'failed' => 0,
            'cancelled' => 0,
            'total' => 1,
        ],
        'metadata' => [],
        'expires_after' => [
            'anchor' => 'last_active_at',
            'days' => 7,
        ],
        'expires_at' => null,
        'last_active_at' => 1715953317,
    ];
}

/**
 * @return array<string, mixed>
 */
function vectorStoreListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            vectorStoreResource(),
            vectorStoreResource(),
        ],
        'first_id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
        'last_id' => 'vs_8VE2cQq1jTFlH7FizhYCzUz0',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function vectorStoreDeleteResource(): array
{
    return [
        'id' => 'vs_xzlnkCbIQE50B9A8RzmcFmtP',
        'object' => 'vector_store.deleted',
        'deleted' => true,
    ];
}
