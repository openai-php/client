<?php

use OpenAI\Responses\Files\ListResponse;
use OpenAI\Responses\Files\RetrieveResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ListResponse::from(fileListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ListResponse::from(fileListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListResponse::from(fileListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fileListResource());
});

test('fake', function () {
    $response = ListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('fake with override', function () {
    $response = ListResponse::fake([
        'data' => [
            [
                'id' => 'file-1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('file-1234');
});
