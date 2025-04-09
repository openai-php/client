<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileDeleteResponse;

test('from', function () {
    $result = VectorStoreFileDeleteResponse::from(vectorStoreFileDeleteResource(), meta());

    expect($result)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->object->toBe('vector_store.file.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = VectorStoreFileDeleteResponse::from(vectorStoreFileDeleteResource(), meta());

    expect($result['id'])
        ->toBe('file-HuwUghQzWasTZeX3uRRawY5R');
});

test('to array', function () {
    $result = VectorStoreFileDeleteResponse::from(vectorStoreFileDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreFileDeleteResource());
});

test('fake', function () {
    $response = VectorStoreFileDeleteResponse::fake();

    expect($response)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = VectorStoreFileDeleteResponse::fake([
        'id' => 'file-1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('file-1234')
        ->deleted->toBe(false);
});
