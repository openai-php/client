<?php

use OpenAI\Responses\VectorStores\FileBatches\VectorStoreFileBatchResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponseFileCounts;

test('from', function () {
    $result = VectorStoreFileBatchResponse::from(vectorStoreFileBatchResource(), meta());

    expect($result)
        ->id->toBe('vsfb_abc123')
        ->object->toBe('vector_store.file_batch')
        ->createdAt->toBe(1699061776)
        ->vectorStoreId->toBe('vs_abc123')
        ->status->toBe('cancelling')
        ->fileCounts->toBeInstanceOf(VectorStoreResponseFileCounts::class);
});

test('as array accessible', function () {
    $result = VectorStoreFileBatchResponse::from(vectorStoreFileBatchResource(), meta());

    expect($result['vector_store_id'])
        ->toBe('vs_abc123');
});

test('to array', function () {
    $result = VectorStoreFileBatchResponse::from(vectorStoreFileBatchResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreFileBatchResource());
});
