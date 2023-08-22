<?php

use OpenAI\Responses\FineTunes\ListResponse;
use OpenAI\Responses\FineTunes\RetrieveResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ListResponse::from(fineTuneListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ListResponse::from(fineTuneListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListResponse::from(fineTuneListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fineTuneListResource());
});

test('fake', function () {
    $response = ListResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->id->toBe('ft-AF1WoRqd3aJAHsqc9NY7iL8F');
});

test('fake with override', function () {
    $response = ListResponse::fake([
        'data' => [
            [
                'id' => 'ft-1234',
            ],
        ],
    ]);

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->id->toBe('ft-1234');
});
