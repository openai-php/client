<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\VectorStores\VectorStoreDeleteResponse;

test('from', function () {
    $result = VectorStoreDeleteResponse::from(vectorStoreDeleteResource(), meta());

    expect($result)
        ->id->toBe('vs_xzlnkCbIQE50B9A8RzmcFmtP')
        ->object->toBe('vector_store.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = VectorStoreDeleteResponse::from(vectorStoreDeleteResource(), meta());

    expect($result['id'])
        ->toBe('vs_xzlnkCbIQE50B9A8RzmcFmtP');
});

test('to array', function () {
    $result = VectorStoreDeleteResponse::from(vectorStoreDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreDeleteResource());
});

test('fake', function () {
    $response = VectorStoreDeleteResponse::fake();

    expect($response)
        ->id->toBe('vs_xzlnkCbIQE50B9A8RzmcFmtP')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = VectorStoreDeleteResponse::fake([
        'id' => 'vz_1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('vz_1234')
        ->deleted->toBe(false);
});
