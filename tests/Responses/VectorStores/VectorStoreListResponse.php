<?php

use OpenAI\Responses\VectorStores\VectorStoreListResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponse;

test('from', function () {
    $result = VectorStoreListResponse::from(vectorStoreListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->{0}->toBeInstanceOf(VectorStoreResponse::class)
        ->firstId->toBe('vs_8VE2cQq1jTFlH7FizhYCzUz0')
        ->lastId->toBe('vs_8VE2cQq1jTFlH7FizhYCzUz0')
        ->hasMore->toBe(false);
});

test('as array accessible', function () {
    $result = VectorStoreListResponse::from(vectorStoreListResource(), meta());

    expect($result['first_id'])
        ->toBe('vs_8VE2cQq1jTFlH7FizhYCzUz0');
});

test('to array', function () {
    $result = VectorStoreListResponse::from(vectorStoreListResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreListResource());
});
