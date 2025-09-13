<?php

use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\EditResponseData;
use OpenAI\Responses\Images\ImageResponseUsage;
use OpenAI\Responses\Images\ImageResponseUsageInputTokensDetails;
use OpenAI\Responses\Meta\MetaInformation;

test('from with url', function () {
    $response = EditResponse::from(imageEditWithUrl(), meta());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeNull();
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
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeNull();
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

test('from with usage', function () {
    $response = EditResponse::from(imageEditWithUsage(), meta());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);
});

test('from with doubao usage', function () {
    $response = EditResponse::from(imageEditWithDoubaoUsage(), meta());

    expect($response)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeNull();
});

test('to array with usage', function () {
    $response = EditResponse::from(imageEditWithUsage(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageEditWithUsage());
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
