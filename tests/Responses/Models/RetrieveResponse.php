<?php

use OpenAI\Responses\Models\RetrieveResponse;
use OpenAI\Responses\Models\RetrieveResponsePermission;
use OpenAI\Responses\ResponseMetaInformation;

test('from', function () {
    $result = RetrieveResponse::from(model(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('text-babbage:001')
        ->object->toBe('model')
        ->created->toBe(1642018370)
        ->ownedBy->toBe('openai')
        ->permission->toBeArray()->toHaveCount(1)
        ->permission->each->toBeInstanceOf(RetrieveResponsePermission::class)
        ->root->toBe('text-babbage:001')
        ->parent->toBe(null)
        ->meta()->toBeInstanceOf(ResponseMetaInformation::class);
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
        ->and($response->permission[0])
        ->allowCreateEngine->toBeFalse();
});

test('fake with override', function () {
    $response = RetrieveResponse::fake([
        'id' => 'text-1234',
        'permission' => [
            [
                'allow_create_engine' => true,
            ],
        ],
    ]);

    expect($response)
        ->id->toBe('text-1234')
        ->and($response->permission[0])
        ->allowCreateEngine->toBeTrue();
});
