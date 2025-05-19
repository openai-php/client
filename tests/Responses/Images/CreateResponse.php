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
        ->meta()->toBeInstanceOf(MetaInformation::class);
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
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($response->data[0])
        ->toBeInstanceOf(CreateResponseData::class)
        ->url->toBeNull()
        ->b64_json->toBe('image_in_base64_format');

    expect($response->usage)->toBeNull();
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
            ],
        ],
    ]);

    expect($response['data'][0])
        ->url->toBe('https://openai.com/new-image.png');
});

test('from with revised prompt', function () {
    $response = CreateResponse::from(imageCreateWithRevisedPrompt(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class)
        ->data[0]->revised_prompt->toBe('A cute baby sea otter with a pearl earring')
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($response->usage)->toBeNull();
});

test('from with usage', function () {
    $response = CreateResponse::from(imageCreateWithUsage(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1);

    expect($response->data[0])
        ->toBeInstanceOf(CreateResponseData::class)
        ->url->toBe('https://openai.com/image.png')
        ->b64_json->toBeNull();

    expect($response->usage)->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);
});

test('as array accessible', function () {
    $response = CreateResponse::from(imageCreateWithUrl(), meta());

    expect($response['created'])->toBe(1664136088);
});

test('to array', function () {
    $response = CreateResponse::from(imageCreateWithUrl(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithUrl());
});

test('to array with usage', function () {
    $response = CreateResponse::from(imageCreateWithUsage(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithUsage());
});
