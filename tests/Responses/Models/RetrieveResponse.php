<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Models\RetrieveResponse;

test('from', function () {
    $result = RetrieveResponse::from(model(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('text-babbage:001')
        ->object->toBe('model')
        ->created->toBe(1642018370)
        ->ownedBy->toBe('openai')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(model(), meta());

    expect($result['id'])->toBe('text-babbage:001');
});

test('to array', function () {
    $result = RetrieveResponse::from(model(), meta());

    expect($result->toArray())
        ->toBe(model());
});

test('fake', function () {
    $response = RetrieveResponse::fake();

    expect($response)
        ->id->toBe('text-babbage:001')
        ->ownedBy->toBe('openai');
});

test('fake with override', function () {
    $response = RetrieveResponse::fake([
        'id' => 'text-1234',
        'owned_by' => 'xyz-dev',
    ]);

    expect($response)
        ->id->toBe('text-1234')
        ->ownedBy->toBe('xyz-dev');
});
