<?php

use OpenAI\Responses\VectorStores\Files\VectorStoreFileListResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;

test('from', function () {
    $result = VectorStoreFileListResponse::from(vectorStoreFileListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->{0}->toBeInstanceOf(VectorStoreFileResponse::class)
        ->firstId->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->lastId->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->hasMore->toBe(false);
});

test('as array accessible', function () {
    $result = VectorStoreFileListResponse::from(vectorStoreFileListResource(), meta());

    expect($result['first_id'])
        ->toBe('file-HuwUghQzWasTZeX3uRRawY5R');
});

test('to array', function () {
    $result = VectorStoreFileListResponse::from(vectorStoreFileListResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreFileListResource());
});
