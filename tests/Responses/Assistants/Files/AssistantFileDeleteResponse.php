<?php

use OpenAI\Responses\Assistants\Files\AssistantFileDeleteResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = AssistantFileDeleteResponse::from(assistantFileDeleteResource(), meta());

    expect($result)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->object->toBe('assistant.file.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = AssistantFileDeleteResponse::from(assistantFileDeleteResource(), meta());

    expect($result['id'])
        ->toBe('file-6EsV79Y261TEmi0PY5iHbZdS');
});

test('to array', function () {
    $result = AssistantFileDeleteResponse::from(assistantFileDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(assistantFileDeleteResource());
});

test('fake', function () {
    $response = AssistantFileDeleteResponse::fake();

    expect($response)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = AssistantFileDeleteResponse::fake([
        'id' => 'file-1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('file-1234')
        ->deleted->toBe(false);
});
