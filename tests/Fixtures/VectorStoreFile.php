<?php

/**
 * @return array<string, mixed>
 */
function vectorStoreFileResource(): array
{
    return [
        'id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'object' => 'vector_store.file',
        'usage_bytes' => 29882,
        'created_at' => 1715956697,
        'vector_store_id' => 'vs_xds05V7ep0QMGI5JmYnWsJwb',
        'status' => 'completed',
        'last_error' => null,
        'chunking_strategy' => [
            'type' => 'static',
            'static' => [
                'max_chunk_size_tokens' => 800,
                'chunk_overlap_tokens' => 400,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function vectorStoreFileWithLastErrorResource(): array
{
    return [
        'id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'object' => 'vector_store.file',
        'usage_bytes' => 29882,
        'created_at' => 1715956697,
        'vector_store_id' => 'vs_xds05V7ep0QMGI5JmYnWsJwb',
        'status' => 'completed',
        'last_error' => [
            'code' => 'error-001',
            'message' => 'Error scanning file',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function vectorStoreFileListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            vectorStoreFileResource(),
            vectorStoreFileResource(),
        ],
        'first_id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'last_id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function vectorStoreFileDeleteResource(): array
{
    return [
        'id' => 'file-HuwUghQzWasTZeX3uRRawY5R',
        'object' => 'vector_store.file.deleted',
        'deleted' => true,
    ];
}
