<?php

use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\CreateResponseData;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\EditResponseData;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Responses\Images\VariationResponseData;
use OpenAI\Responses\ResponseMetaInformation;

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
        ->data->each->toBeInstanceOf(CreateResponseData::class);

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(ResponseMetaInformation::class);
});

test('edit', function () {
    $client = mockClient('POST', 'images/edits', [
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageEditWithUrl(), metaHeaders()));

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
        ->data->each->toBeInstanceOf(EditResponseData::class);

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(ResponseMetaInformation::class);
});

test('variation', function () {
    $client = mockClient('POST', 'images/variations', [
        'image' => fileResourceResource(),
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'url',
    ], \OpenAI\ValueObjects\Transporter\Response::from(imageVariationWithUrl(), metaHeaders()));

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
        ->data->each->toBeInstanceOf(VariationResponseData::class);

    expect($result->data[0])
        ->url->toBe('https://openai.com/image.png');

    expect($result->meta())
        ->toBeInstanceOf(ResponseMetaInformation::class);
});
