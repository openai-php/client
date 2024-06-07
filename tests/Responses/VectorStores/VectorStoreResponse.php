<?php

use OpenAI\Responses\VectorStores\VectorStoreResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponseFileCounts;

test('from', function () {
    $result = VectorStoreResponse::from(vectorStoreResource(), meta());

    expect($result)
        ->id->toBe('vs_8VE2cQq1jTFlH7FizhYCzUz0')
        ->object->toBe('vector_store')
        ->name->toBe('Product Knowledge Base')
        ->status->toBe('completed')
        ->usageBytes->toBe(29882)
        ->createdAt->toBe(1715953317)
        ->fileCounts->toBeInstanceOf(VectorStoreResponseFileCounts::class)
        ->expiresAfter->toBeNull()
        ->expiresAt->toBeNull()
        ->lastActiveAt->toBe(1715953317)
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();
});

test('as array accessible', function () {
    $result = VectorStoreResponse::from(vectorStoreResource(), meta());

    expect($result['usage_bytes'])
        ->toBe(29882);
});

test('to array', function () {
    $result = VectorStoreResponse::from(vectorStoreResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreResource());
});
