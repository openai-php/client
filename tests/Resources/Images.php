<?php

use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\CreateResponseData;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\EditResponseData;
use OpenAI\Responses\Images\ImageResponseUsage;
use OpenAI\Responses\Images\ImageResponseUsageInputTokensDetails;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Responses\Images\VariationResponseData;
use OpenAI\Responses\Meta\MetaInformation;

test('create', function () {
    $client = mockClient('POST', 'images/generations', [
        'prompt' => 'A cute baby sea otter',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageCreateWithUrl(), metaHeaders()));

    $result = $client->images()->create([
        'prompt' => 'A cute baby sea otter',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class)
        ->usage->toBeNull();

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create with usage', function () {
    $client = mockClient('POST', 'images/generations', [
        'prompt' => 'A cute baby sea otter',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageCreateWithUsage(), metaHeaders()));

    $result = $client->images()->create([
        'prompt' => 'A cute baby sea otter',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('edit', function () {
    $client = mockClient('POST', 'images/edits', [
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageEditWithUrl(), metaHeaders()), validateParams: false);

    $result = $client->images()->edit([
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ]);

    expect($result)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->usage->toBeNull();

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('edit with usage', function () {
    $client = mockClient('POST', 'images/edits', [
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageEditWithUsage(), metaHeaders()), validateParams: false);

    $result = $client->images()->edit([
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ]);

    expect($result)
        ->toBeInstanceOf(EditResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(EditResponseData::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('variation', function () {
    $client = mockClient('POST', 'images/variations', [
        'image' => fileResourceResource(),
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageVariationWithUrl(), metaHeaders()), validateParams: false);

    $result = $client->images()->variation([
        'image' => fileResourceResource(),
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ]);

    expect($result)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class)
        ->usage->toBeNull();

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('variation with usage', function () {
    $client = mockClient('POST', 'images/variations', [
        'image' => fileResourceResource(),
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageVariationWithUsage(), metaHeaders()), validateParams: false);

    $result = $client->images()->variation([
        'image' => fileResourceResource(),
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ]);

    expect($result)
        ->toBeInstanceOf(VariationResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(VariationResponseData::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
