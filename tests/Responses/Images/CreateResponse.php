<?php

use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\CreateResponseData;
use OpenAI\Responses\Images\ImageResponseUsage;
use OpenAI\Responses\Images\ImageResponseUsageInputTokensDetails;
use OpenAI\Responses\Meta\MetaInformation;

test('from with url', function () {
    $response = CreateResponse::from(imageCreateWithUrl(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeNull();
});

test('as array accessible with url', function () {
    $response = CreateResponse::from(imageCreateWithUrl(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array with url', function () {
    $response = CreateResponse::from(imageCreateWithUrl(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithUrl());
});

test('from with b64_json', function () {
    $response = CreateResponse::from(imageCreateWithB46Json(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class)
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->usage->toBeNull();
});

test('as array accessible with b64_json', function () {
    $response = CreateResponse::from(imageCreateWithB46Json(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array with b64_json', function () {
    $response = CreateResponse::from(imageCreateWithB46Json(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithB46Json());
});

test('from with usage', function () {
    $response = CreateResponse::from(imageCreateWithUsage(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class)
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
    $response = CreateResponse::from(imageCreateWithUsage(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithUsage());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response['data'][0])
        ->url->toBe('https://openai.com/fake-image.png');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'data' => [
            [
                'url' => 'https://openai.com/new-image.png',
                'revised_prompt' => 'the revised prompt',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->url->toBe('https://openai.com/new-image.png')
        ->revised_prompt->toBe('the revised prompt');
});

test('fake with override of b64_json', function () {
    $response = CreateResponse::fake([
        'data' => [
            [
                'url' => '',
                'b64_json' => 'some-fake-b64-string',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->b64_json->toBe('some-fake-b64-string');
});
