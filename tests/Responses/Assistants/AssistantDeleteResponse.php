<?php

use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = AssistantDeleteResponse::from(assistantDeleteResource(), meta());

    expect($result)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = AssistantDeleteResponse::from(assistantDeleteResource(), meta());

    expect($result['id'])
        ->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('to array', function () {
    $result = AssistantDeleteResponse::from(assistantDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(assistantDeleteResource());
});

test('fake', function () {
    $response = AssistantDeleteResponse::fake();

    expect($response)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = AssistantDeleteResponse::fake([
        'id' => 'asst_1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('asst_1234')
        ->deleted->toBe(false);
});
