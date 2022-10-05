<?php

use OpenAI\Responses\Files\ListResponse;
use OpenAI\Responses\Files\RetrieveResponse;

test('from', function () {
    $response = ListResponse::from(fileListResource());

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class);
});

test('as array accessible', function () {
    $response = ListResponse::from(fileListResource());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListResponse::from(fileListResource());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fileListResource());
});
