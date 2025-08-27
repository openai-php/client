<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateResponseFormat;
use OpenAI\Responses\Responses\CreateResponseReasoning;
use OpenAI\Responses\Responses\CreateResponseUsage;
use OpenAI\Testing\Enums\OverrideStrategy;

test('from', function () {
    $response = CreateResponse::from(createResponseResource(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response')
        ->createdAt->toBe(1741484430)
        ->status->toBe('completed')
        ->error->toBeNull()
        ->incompleteDetails->toBeNull()
        ->instructions->toBeNull()
        ->maxOutputTokens->toBeNull()
        ->model->toBe('gpt-4o-2024-08-06')
        ->output->toBeArray()
        ->parallelToolCalls->toBeTrue()
        ->previousResponseId->toBeNull()
        ->reasoning->toBeInstanceOf(CreateResponseReasoning::class)
        ->store->toBeTrue()
        ->temperature->toBe(1.0)
        ->text->toBeInstanceOf(CreateResponseFormat::class)
        ->toolChoice->toBe('auto')
        ->tools->toBeArray()
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled')
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->user->toBeNull()
        ->metadata->toBe([]);

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(createResponseResource(), meta());

    expect($response['id'])->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('to array', function () {
    $response = CreateResponse::from(createResponseResource(), meta());

    $expected = createResponseResource();
    $expected['output_text'] = 'As of today, March 9, 2025, one notable positive news story...';

    expect($response->toArray())
        ->toBeArray()
        ->toBe($expected);
});

test('to array with no messages', function () {
    $payload = createResponseResource();
    $payload['output'] = [
        outputMessageOnlyRefusal(),
    ];

    $response = CreateResponse::from($payload, meta());

    expect($response->toArray())
        ->toBeArray()
        ->outputText->toBeNull();
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('fake with the "replace" and "merge" strategy override', function () {
    $attributes = [
        'output' => [
            [
                'id' => 'msg_67ccd2bf17f0819081ff3bb2cf6508e60bb6a6b452d3795b',
                'role' => 'assistant',
                'type' => 'message',
                'status' => 'completed',
                'content' => [
                    [
                        'type' => 'output_text',
                        'text' => 'This is the fake test output',
                        'annotations' => [],
                    ],
                ],
            ],
        ],
    ];
    $response = CreateResponse::fake(
        $attributes,
        strategy: OverrideStrategy::Replace
    );

    expect($response)
        ->output->toBeArray()->toHaveCount(1)
        ->outputText->toBe('This is the fake test output');

    $response = CreateResponse::fake(
        $attributes,
    );

    expect($response)
        ->output->toBeArray()->toHaveCount(2)
        ->outputText->toBe('This is the fake test output As of today, March 9, 2025, one notable positive news story...');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'resp_1234',
        'object' => 'custom_response',
        'status' => 'failed',
        'output' => [
            outputBasicMessage(),
        ],
    ]);

    expect($response)
        ->id->toBe('resp_1234')
        ->object->toBe('custom_response')
        ->status->toBe('failed')
        ->output->toBeArray();

    expect($response->output[0]['content'][0])
        ->type->toBe('output_text')
        ->text->toBe('This is a basic message.');
});

test('from with missing store field defaults to true', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->store->toBeTrue();
});

test('from with null store field defaults to true', function () {
    $response = CreateResponse::fake(['store' => null]);

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->store->toBeTrue();
});

test('from with false store field', function () {
    $response = CreateResponse::fake(['store' => false]);

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->store->toBeFalse();
});

test('from with missing text field', function () {
    $response = CreateResponse::fake(['text' => null]);

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->text->toBeNull();
});

test('from with null text field', function () {
    $response = CreateResponse::fake(['text' => null]);

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->text->toBeNull();
});

test('to array with null text field', function () {
    $response = CreateResponse::fake(['text' => null]);

    $array = $response->toArray();

    expect($array)
        ->toBeArray()
        ->text->toBeNull();
});
