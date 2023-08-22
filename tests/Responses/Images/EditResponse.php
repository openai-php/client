<?php

use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\EditResponseData;
use OpenAI\Responses\Meta\MetaInformation;

test('from with url', function () {
    $response = EditResponse::from(imageEditWithUrl(), meta());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible with url', function () {
    $response = EditResponse::from(imageEditWithUrl(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array with url', function () {
    $response = EditResponse::from(imageEditWithUrl(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageEditWithUrl());
});

test('from with b64_json', function () {
    $response = EditResponse::from(imageEditWithB46Json(), meta());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible with b64_json', function () {
    $response = EditResponse::from(imageEditWithB46Json(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array with b64_json', function () {
    $response = EditResponse::from(imageEditWithB46Json(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageEditWithB46Json());
});

test('fake', function () {
    $response = EditResponse::fake();

    expect($response['data'][0])
        ->url->toBe('https://openai.com/fake-image.png');
});

test('fake with override', function () {
    $response = EditResponse::fake([
        'data' => [
            [
                'url' => 'https://openai.com/new-image.png',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->url->toBe('https://openai.com/new-image.png');
});
