<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponseFormat;
use OpenAI\Responses\Responses\CreateResponseReasoning;
use OpenAI\Responses\Responses\CreateResponseUsage;
use OpenAI\Responses\Responses\RetrieveResponse;

test('from', function () {
    $result = RetrieveResponse::from(retrieveResponseResource(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
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
        ->output->toHaveCount(2)
        ->parallelToolCalls->toBeTrue()
        ->previousResponseId->toBeNull()
        ->reasoning->toBeInstanceOf(CreateResponseReasoning::class)
        ->store->toBeTrue()
        ->temperature->toBe(1.0)
        ->text->toBeInstanceOf(CreateResponseFormat::class)
        ->toolChoice->toBe('auto')
        ->tools->toBeArray()
        ->tools->toHaveCount(1)
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled')
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->user->toBeNull()
        ->metadata->toBe([]);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(retrieveResponseResource(), meta());

    expect($result['id'])->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('to array', function () {
    $result = RetrieveResponse::from(retrieveResponseResource(), meta());

    expect($result->toArray())
        ->toBe(retrieveResponseResource());
});

test('fake', function () {
    $response = RetrieveResponse::fake();

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response')
        ->status->toBe('completed');
});

test('fake with override', function () {
    $response = RetrieveResponse::fake([
        'id' => 'resp_1234',
        'object' => 'custom_response',
        'status' => 'failed',
    ]);

    expect($response)
        ->id->toBe('resp_1234')
        ->object->toBe('custom_response')
        ->status->toBe('failed');
});
