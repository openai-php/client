<?php

use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\EditResponseData;

test('from with url', function () {
    $response = EditResponse::from(imageEditWithUrl());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class);
});

test('as array accessible with url', function () {
    $response = EditResponse::from(imageEditWithUrl());

    expect($response['created'])->toBe(1664136088);
});

test('to array with url', function () {
    $response = EditResponse::from(imageEditWithUrl());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageEditWithUrl());
});

test('from with b64_json', function () {
    $response = EditResponse::from(imageEditWithB46Json());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class);
});

test('as array accessible with b64_json', function () {
    $response = EditResponse::from(imageEditWithB46Json());

    expect($response['created'])->toBe(1664136088);
});

test('to array with b64_json', function () {
    $response = EditResponse::from(imageEditWithB46Json());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageEditWithB46Json());
});

test('fake', function () {
    $response = EditResponse::fake();

    expect($response['data'][0])
        ->url->toBe('https://openai.com/image.png');
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
