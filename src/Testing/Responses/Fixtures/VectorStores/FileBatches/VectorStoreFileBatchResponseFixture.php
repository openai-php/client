<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores\FileBatches;

final class VectorStoreFileBatchResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'vsfb_abc123',
        'object' => 'vector_store.file_batch',
        'created_at' => 1_715_956_697,
        'vector_store_id' => 'vs_xds05V7ep0QMGI5JmYnWsJwb',
        'status' => 'completed',
        'file_counts' => [
            'in_progress' => 0,
            'completed' => 1,
            'failed' => 0,
            'cancelled' => 0,
            'total' => 1,
        ],
    ];
}
