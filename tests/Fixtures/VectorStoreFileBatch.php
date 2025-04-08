<?php

/**
 * @return array<string, mixed>
 */
function vectorStoreFileBatchResource(): array
{
    return [
        'id' => 'vsfb_abc123',
        'object' => 'vector_store.file_batch',
        'created_at' => 1699061776,
        'vector_store_id' => 'vs_abc123',
        'status' => 'cancelling',
        'file_counts' => [
            'in_progress' => 12,
            'completed' => 3,
            'failed' => 0,
            'cancelled' => 0,
            'total' => 15,
        ],
    ];
}
