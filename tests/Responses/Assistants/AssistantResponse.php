<?php

use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\Responses\Assistants\AssistantResponseResponseFormat;
use OpenAI\Responses\Assistants\AssistantResponseToolCodeInterpreter;
use OpenAI\Responses\Assistants\AssistantResponseToolFileSearch;
use OpenAI\Responses\Assistants\AssistantResponseToolResources;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = AssistantResponse::from(assistantWithAllToolsResource(), meta());

    expect($result)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant')
        ->createdAt->toBe(1699619403)
        ->name->toBe('Math Tutor')
        ->description->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor.')
        ->tools->toBeArray()
        ->tools->{0}->toBeInstanceOf(AssistantResponseToolCodeInterpreter::class)
        ->toolResources->toBeInstanceOf(AssistantResponseToolResources::class)
        ->metadata->toBeArray()
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->temperature->toBe(0.7)
        ->topP->toBe(1.0)
        ->responseFormat->toBe('text');
});

test('with file search', function () {
    $result = AssistantResponse::from(assistantWithToolResources(), meta());

    expect($result)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant')
        ->createdAt->toBe(1699619403)
        ->name->toBe('Math Tutor')
        ->description->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor.')
        ->tools->toBeArray()
        ->tools->{0}->toBeInstanceOf(AssistantResponseToolFileSearch::class)
        ->toolResources->toBeInstanceOf(AssistantResponseToolResources::class)
        ->metadata->toBeArray()
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->temperature->toBe(0.7)
        ->topP->toBe(1.0)
        ->responseFormat->toBe('text');
});

test('with code interpreter', function () {
    $result = AssistantResponse::from(assistantWithToolResources(), meta());

    expect($result)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant')
        ->createdAt->toBe(1699619403)
        ->name->toBe('Math Tutor')
        ->description->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor.')
        ->tools->toBeArray()
        ->tools->{0}->toBeInstanceOf(AssistantResponseToolFileSearch::class)
        ->toolResources->toBeInstanceOf(AssistantResponseToolResources::class)
        ->metadata->toBeArray()
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->temperature->toBe(0.7)
        ->topP->toBe(1.0)
        ->responseFormat->toBe('text');
});

test('with json object response format', function () {
    $result = AssistantResponse::from(assistantWithJsonObjectResponseFormat(), meta());

    expect($result)
        ->responseFormat->toBeInstanceOf(AssistantResponseResponseFormat::class);
});

test('as array accessible', function () {
    $result = AssistantResponse::from(assistantWithAllToolsResource(), meta());

    expect($result['id'])
        ->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('to array', function () {
    $result = AssistantResponse::from(assistantWithAllToolsResource(), meta());

    expect($result->toArray())
        ->toBe(assistantWithAllToolsResource());
});

test('fake', function () {
    $response = AssistantResponse::fake();

    expect($response)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('fake with override', function () {
    $response = AssistantResponse::fake([
        'id' => 'asst_1234',
        'metadata' => [
            'key' => 'value',
        ],
    ]);

    expect($response)
        ->id->toBe('asst_1234')
        ->metadata->toBeArray()
        ->metadata->key->toBe('value');
});
