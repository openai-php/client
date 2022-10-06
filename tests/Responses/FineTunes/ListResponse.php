<?php

use OpenAI\Responses\FineTunes\ListResponse;
use OpenAI\Responses\FineTunes\RetrieveResponse;

test('from', function () {
    $response = ListResponse::from(fineTuneListResource());

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class);
});

test('as array accessible', function () {
    $response = ListResponse::from(fineTuneListResource());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListResponse::from(fineTuneListResource());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fineTuneListResource());
});
