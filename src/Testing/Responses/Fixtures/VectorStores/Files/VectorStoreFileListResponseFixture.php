<?php

namespace OpenAI\Testing\Responses\Fixtures\VectorStores\Files;

final class VectorStoreFileListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
                'object' => 'vector_store.file',
                'usage_bytes' => 29882,
                'created_at' => 1_715_956_697,
                'vector_store_id' => 'vs_xds05V7ep0QMGI5JmYnWsJwb',
                'status' => 'completed',
                'attributes' => [],
                'last_error' => null,
            ],
        ],
        'first_id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'last_id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'has_more' => false,
    ];
}
