<?php

use OpenAI\Responses\Images\ImageResponseUsage;
use OpenAI\Responses\Images\ImageResponseUsageInputTokensDetails;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Responses\Images\VariationResponseData;
use OpenAI\Responses\Meta\MetaInformation;

test('from with url', function () {
    $response = VariationResponse::from(imageVariationWithUrl(), meta());

    expect($response)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeNull();
});

test('as array accessible with url', function () {
    $response = VariationResponse::from(imageVariationWithUrl(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array with url', function () {
    $response = VariationResponse::from(imageVariationWithUrl(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageVariationWithUrl());
});

test('from with b64_json', function () {
    $response = VariationResponse::from(imageVariationWithB46Json(), meta());

    expect($response)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeNull();
});

test('as array accessible with b64_json', function () {
    $response = VariationResponse::from(imageVariationWithB46Json(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array with b64_json', function () {
    $response = VariationResponse::from(imageVariationWithB46Json(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageVariationWithB46Json());
});

test('from with usage', function () {
    $response = VariationResponse::from(imageVariationWithUsage(), meta());

    expect($response)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);
});

test('to array with usage', function () {
    $response = VariationResponse::from(imageVariationWithUsage(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageVariationWithUsage());
});

test('fake', function () {
    $response = VariationResponse::fake();

    expect($response['data'][0])
        ->url->toBe('https://openai.com/fake-image.png');
});

test('fake with override', function () {
    $response = VariationResponse::fake([
        'data' => [
            [
                'url' => 'https://openai.com/new-image.png',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->url->toBe('https://openai.com/new-image.png');
});
