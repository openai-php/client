<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;

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
        ->output->toHaveCount(2)
        ->parallelToolCalls->toBeTrue()
        ->previousResponseId->toBeNull()
        ->reasoning->toBeArray()
        ->store->toBeTrue()
        ->temperature->toBe(1.0)
        ->text->toBeArray()
        ->toolChoice->toBe('auto')
        ->tools->toBeArray()
        ->tools->toHaveCount(1)
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled')
        ->usage->toBeArray()
        ->usage->toHaveCount(5)
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
