<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateResponseFormat;
use OpenAI\Responses\Responses\CreateResponseReasoning;
use OpenAI\Responses\Responses\CreateResponseUsage;

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

    expect($response->toArray())
        ->toBeArray()
        ->toBe(createResponseResource());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'resp_1234',
        'object' => 'custom_response',
        'status' => 'failed',
    ]);

    expect($response)
        ->id->toBe('resp_1234')
        ->object->toBe('custom_response')
        ->status->toBe('failed');
});
