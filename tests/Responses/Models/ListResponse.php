<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Models\ListResponse;
use OpenAI\Responses\Models\RetrieveResponse;

test('from', function () {
    $response = ListResponse::from(modelList(), meta());

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ListResponse::from(modelList(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListResponse::from(modelList(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(modelList());
});

test('fake', function () {
    $response = ListResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->and($response->data[0])
        ->id->toBe('text-babbage:001');
});

test('fake with override', function () {
    $response = ListResponse::fake([
        'data' => [
            [
                'id' => 'text-1234',
            ],
        ],
    ]);

    expect($response)
        ->object->toBe('list')
        ->and($response->data[0])
        ->id->toBe('text-1234');
});
