<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\VectorStores\VectorStoreDeleteResponse;
use OpenAI\Responses\VectorStores\VectorStoreListResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponseFileCounts;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'vector_stores', [], Response::from(vectorStoreResource(), metaHeaders()));

    $result = $client->vectorStores()->create([]);

    expect($result)
        ->toBeInstanceOf(VectorStoreResponse::class)
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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'vector_stores', [], Response::from(vectorStoreListResource(), metaHeaders()));

    $result = $client->vectorStores()->list();

    expect($result)
        ->toBeInstanceOf(VectorStoreListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->{0}->toBeInstanceOf(VectorStoreResponse::class)
        ->firstId->toBe('vs_8VE2cQq1jTFlH7FizhYCzUz0')
        ->lastId->toBe('vs_8VE2cQq1jTFlH7FizhYCzUz0')
        ->hasMore->toBe(false);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('modify', function () {
    $client = mockClient('POST', 'vector_stores/vs_8VE2cQq1jTFlH7FizhYCzUz0', [
        'metadata' => [
            'modified_by' => 'Jane Doe',
        ],
    ], Response::from(vectorStoreResource(), metaHeaders()));

    $result = $client->vectorStores()->modify('vs_8VE2cQq1jTFlH7FizhYCzUz0', [
        'metadata' => [
            'modified_by' => 'Jane Doe',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(VectorStoreResponse::class)
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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'vector_stores/vs_8VE2cQq1jTFlH7FizhYCzUz0', [], Response::from(vectorStoreResource(), metaHeaders()));

    $result = $client->vectorStores()->retrieve('vs_8VE2cQq1jTFlH7FizhYCzUz0');

    expect($result)
        ->toBeInstanceOf(VectorStoreResponse::class)
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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'vector_stores/vs_xzlnkCbIQE50B9A8RzmcFmtP', [], Response::from(vectorStoreDeleteResource(), metaHeaders()));

    $result = $client->vectorStores()->delete('vs_xzlnkCbIQE50B9A8RzmcFmtP');

    expect($result)
        ->toBeInstanceOf(VectorStoreDeleteResponse::class)
        ->id->toBe('vs_xzlnkCbIQE50B9A8RzmcFmtP')
        ->object->toBe('vector_store.deleted')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
