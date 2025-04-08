<?php

use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponseChunkingStrategyStatic;

test('from', function () {
    $result = VectorStoreFileResponse::from(vectorStoreFileResource(), meta());

    expect($result)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->object->toBe('vector_store.file')
        ->usageBytes->toBe(29882)
        ->createdAt->toBe(1715956697)
        ->vectorStoreId->toBe('vs_xds05V7ep0QMGI5JmYnWsJwb')
        ->status->toBe('completed')
        ->lastError->toBeNull()
        ->chunkingStrategy->toBeInstanceOf(VectorStoreFileResponseChunkingStrategyStatic::class)
        ->chunkingStrategy->type->toBe('static')
        ->chunkingStrategy->maxChunkSizeTokens->toBe(800)
        ->chunkingStrategy->chunkOverlapTokens->toBe(400);
});

test('as array accessible', function () {
    $result = VectorStoreFileResponse::from(vectorStoreFileResource(), meta());

    expect($result['vector_store_id'])
        ->toBe('vs_xds05V7ep0QMGI5JmYnWsJwb');
});

test('to array', function () {
    $result = VectorStoreFileResponse::from(vectorStoreFileResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreFileResource());
});
