<?php

use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Responses\Images\VariationResponseData;

test('from with url', function () {
    $response = VariationResponse::from(imageVariationWithUrl());

    expect($response)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class);
});

test('as array accessible with url', function () {
    $response = VariationResponse::from(imageVariationWithUrl());

    expect($response['created'])->toBe(1664136088);
});

test('to array with url', function () {
    $response = VariationResponse::from(imageVariationWithUrl());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageVariationWithUrl());
});

test('from with b64_json', function () {
    $response = VariationResponse::from(imageVariationWithB46Json());

    expect($response)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class);
});

test('as array accessible with b64_json', function () {
    $response = VariationResponse::from(imageVariationWithB46Json());

    expect($response['created'])->toBe(1664136088);
});

test('to array with b64_json', function () {
    $response = VariationResponse::from(imageVariationWithB46Json());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageVariationWithB46Json());
});
