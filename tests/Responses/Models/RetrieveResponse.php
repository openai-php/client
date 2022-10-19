<?php

use OpenAI\Responses\Models\RetrieveResponse;
use OpenAI\Responses\Models\RetrieveResponsePermission;

test('from', function () {
    $result = RetrieveResponse::from(model());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('text-babbage:001')
        ->object->toBe('model')
        ->created->toBe(1642018370)
        ->ownedBy->toBe('openai')
        ->permission->toBeArray()->toHaveCount(1)
        ->permission->each->toBeInstanceOf(RetrieveResponsePermission::class)
        ->root->toBe('text-babbage:001')
        ->parent->toBe(null);
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(model());

    expect($result['id'])->toBe('text-babbage:001');
});

test('to array', function () {
    $result = RetrieveResponse::from(model());

    expect($result->toArray())
        ->toBe(model());
});
