<?php

use OpenAI\Responses\Assistants\Files\AssistantFileResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = AssistantFileResponse::from(assistantFileResource(), meta());

    expect($result)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->object->toBe('assistant.file')
        ->createdAt->toBe(1699620898)
        ->assistantId->toBe('asst_y49lAdZDiaQUxEBR6zrG846Q')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = AssistantFileResponse::from(assistantFileResource(), meta());

    expect($result['id'])
        ->toBe('file-6EsV79Y261TEmi0PY5iHbZdS');
});

test('to array', function () {
    $result = AssistantFileResponse::from(assistantFileResource(), meta());

    expect($result->toArray())
        ->toBe(assistantFileResource());
});

test('fake', function () {
    $response = AssistantFileResponse::fake();

    expect($response)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS');
});

test('fake with override', function () {
    $response = AssistantFileResponse::fake([
        'id' => 'file-1234',
    ]);

    expect($response)
        ->id->toBe('file-1234');
});
