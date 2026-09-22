<?php

use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponseChunkingStrategyOther;
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
        ->attributes->toBe(['foo' => 'bar'])
        ->lastError->toBeNull()
        ->chunkingStrategy->toBeInstanceOf(VectorStoreFileResponseChunkingStrategyStatic::class)
        ->chunkingStrategy->type->toBe('static')
        ->chunkingStrategy->maxChunkSizeTokens->toBe(800)
        ->chunkingStrategy->chunkOverlapTokens->toBe(400);
});

test('from while missing attributes', function () {
    $payload = vectorStoreFileResource();
    unset($payload['attributes']);
    $result = VectorStoreFileResponse::from($payload, meta());

    expect($result)
        ->attributes->toBe([]);
});

test('from while missing chunking strategy', function () {
    $payload = vectorStoreFileResource();
    unset($payload['chunking_strategy']);

    $result = VectorStoreFileResponse::from($payload, meta());

    expect($result)
        ->chunkingStrategy->toBeNull();

    expect($result->toArray()['chunking_strategy'])
        ->toBeNull();
});

test('from with other chunking strategy', function () {
    $payload = vectorStoreFileResource();
    $payload['chunking_strategy'] = ['type' => 'other'];

    $result = VectorStoreFileResponse::from($payload, meta());

    expect($result->chunkingStrategy)
        ->toBeInstanceOf(VectorStoreFileResponseChunkingStrategyOther::class);
    expect($result->toArray()['chunking_strategy'])
        ->toBe(['type' => 'other']);
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
