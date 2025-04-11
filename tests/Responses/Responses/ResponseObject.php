<?php

use OpenAI\Responses\Responses\ResponseObject;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = ResponseObject::from(responseObject(), meta());

    expect($result)
        ->toBeInstanceOf(ResponseObject::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response')
        ->createdAt->toBe(1699619403)
        ->status->toBe('completed')
        ->output->toBeArray()
        ->output->toHaveCount(1)
        ->type->toBe('message')
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->status->toBe('completed')
        ->role->toBe('assistant')
        ->content->toBeArray()
        ->content[0]->toBeInstanceOf(ResponseObject::class)
        ->content[0]->type->toBe('output_text')
        ->content[0]->text->toBe('The image depicts a scenic landscape with a wooden boardwalk or pathway leading through lush, green grass under a blue sky with some clouds. The setting suggests a peaceful natural area, possibly a park or nature reserve. There are trees and shrubs in the background.')
        ->content[0]->annotations->toBeArray()
        ->content[0]->annotations->toHaveCount(0)
        ->parallelToolCalls->toBeTrue()
        ->previousResponseId->toBeNull()
        ->reasoning->toBeArray()
        ->reasoning['effort']->toBeNull()
        ->reasoning['generate_summary']->toBeNull()
        ->store->toBeTrue()
        ->temperature->toBe(1.0)
        ->text->toBeArray()
        ->text['format']['type']->toBe('text')
        ->toolChoice->toBe('auto')
        ->tools->toBeArray()
        ->tools->toHaveCount(0)
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled')
        ->usage->toBeArray()
        ->usage['input_tokens']->toBe(328)
        ->usage['input_tokens_details']['cached_tokens']->toBe(0)
        ->usage['output_tokens']->toBe(52)
        ->usage['output_tokens_details']['reasoning_tokens']->toBe(0)
        ->usage['total_tokens']->toBe(380)
        ->user->toBeNull()
        ->metadata->toBeArray()
        ->metadata->toBeEmpty()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ResponseObject::from(responseObject(), meta());

    expect($result['id'])->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('to array', function () {
    $result = ResponseObject::from(responseObject(), meta());

    expect($result->toArray())
        ->toBeArray()
        ->toBe(responseObject());
});

test('fake', function () {
    $response = ResponseObject::fake();

    expect($response)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response')
        ->status->toBe('completed');
});

test('fake with override', function () {
    $response = ResponseObject::fake([
        'id' => 'asst_1234',
        'object' => 'custom_response',
        'status' => 'failed'
    ]);

    expect($response)
        ->id->toBe('asst_1234')
        ->object->toBe('custom_response')
        ->status->toBe('failed');
});

test('from', function () {
    $result = ResponseObject::from(responseObject(), meta());

    expect($result)
        ->toBeInstanceOf(ResponseObject::class)
        ->object->toBe('response')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ResponseObject::from(responseObject(), meta());

    expect($result['object'])->toBe('response');
});

test('to array', function () {
    $result = ResponseObject::from(responseObject(), meta());

    expect($result->toArray())
        ->toBe(responseObject());
});

test('fake', function () {
    $response = ResponseObject::fake();

    expect($response)
        ->object->toBe('response');
});

test('fake with override', function () {
    $response = ResponseObject::fake([
        'object' => 'custom_response'
    ]);

    expect($response)
        ->object->toBe('custom_response');
});
