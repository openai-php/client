<?php
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\ResponseObject;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = CreateResponse::from(createResponse(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response')
        ->createdAt->toBe(1699619403)
        ->status->toBe('completed')
        ->output->toBeArray()
        ->output->toHaveCount(1)
        ->output[0]->toBeInstanceOf(ResponseObject::class)
        ->output[0]->type->toBe('message')
        ->output[0]->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->output[0]->status->toBe('completed')
        ->output[0]->role->toBe('assistant')
        ->output[0]->content->toBeArray()
        ->output[0]->content[0]->toBeInstanceOf(ResponseObject::class)
        ->output[0]->content[0]->type->toBe('output_text')
        ->output[0]->content[0]->text->toBe('The image depicts a scenic landscape with a wooden boardwalk or pathway leading through lush, green grass under a blue sky with some clouds. The setting suggests a peaceful natural area, possibly a park or nature reserve. There are trees and shrubs in the background.')
        ->output[0]->content[0]->annotations->toBeArray()
        ->output[0]->content[0]->annotations->toHaveCount(0)
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
        ->metadata->toBeEmpty();

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(createResponse(), meta());

    expect($response['id'])->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('to array', function () {
    $response = CreateResponse::from(createResponse(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(createResponse());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'asst_1234',
    ]);

    expect($response)
        ->id->toBe('asst_1234');
});
