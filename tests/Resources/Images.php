<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\CreateResponseData;
use OpenAI\Responses\Images\CreateStreamedResponse;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\EditResponseData;
use OpenAI\Responses\Images\EditStreamedResponse;
use OpenAI\Responses\Images\ImageResponseUsage;
use OpenAI\Responses\Images\ImageResponseUsageInputTokensDetails;
use OpenAI\Responses\Images\Streaming\ImageGenerationCompleted;
use OpenAI\Responses\Images\Streaming\ImageGenerationPartialImage;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Responses\Images\VariationResponseData;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\StreamResponse;

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

test('create streamed', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(imageCreateStream()),
    );

    $client = mockStreamClient('POST', 'images/generations', [
        'prompt' => 'A cute baby sea otter',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'b64_json',
        'stream' => true,
    ], $response);

    $result = $client->images()->createStreamed([
        'prompt' => 'A cute baby sea otter',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'b64_json',
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    $first = $result->getIterator()->current();

    expect($first)
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('image_generation.partial_image');

    expect($first->response)
        ->toBeInstanceOf(ImageGenerationPartialImage::class)
        ->b64Json->toBe('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
        ->createdAt->toBe(1719946519)
        ->partialImageIndex->toBe(0);

    $iterator = iterator_to_array($result->getIterator());
    $last = end($iterator);

    expect($last->response)
        ->toBeInstanceOf(ImageGenerationCompleted::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(100)
        ->usage->inputTokens->toBe(50)
        ->usage->outputTokens->toBe(50)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(10)
        ->usage->inputTokensDetails->imageTokens->toBe(40);

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

test('edit streamed', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(imageEditStream()),
    );

    $client = mockStreamClient('POST', 'images/edits', [
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'b64_json',
        'stream' => 'true',
    ], $response, validateParams: false);

    $result = $client->images()->editStreamed([
        'image' => fileResourceResource(),
        'mask' => fileResourceResource(),
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
        'n' => 1,
        'size' => '256x256',
        'response_format' => 'b64_json',
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    $first = $result->getIterator()->current();

    expect($first)
        ->toBeInstanceOf(EditStreamedResponse::class)
        ->event->toBe('image_edit.partial_image');

    expect($first->response)
        ->toBeInstanceOf(ImageGenerationPartialImage::class)
        ->b64Json->toBe('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
        ->createdAt->toBe(1719946519)
        ->partialImageIndex->toBe(0);

    $iterator = iterator_to_array($result->getIterator());
    $last = end($iterator);

    expect($last->response)
        ->toBeInstanceOf(ImageGenerationCompleted::class)
        ->usage->toBeInstanceOf(ImageResponseUsage::class)
        ->usage->totalTokens->toBe(200)
        ->usage->inputTokens->toBe(120)
        ->usage->outputTokens->toBe(80)
        ->usage->inputTokensDetails->toBeInstanceOf(ImageResponseUsageInputTokensDetails::class)
        ->usage->inputTokensDetails->textTokens->toBe(40)
        ->usage->inputTokensDetails->imageTokens->toBe(80);

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
