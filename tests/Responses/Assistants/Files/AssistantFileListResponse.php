<?php

use OpenAI\Responses\Assistants\Files\AssistantFileListResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = AssistantFileListResponse::from(assistantFileListResource(), meta());

    expect($response)
        ->toBeInstanceOf(AssistantFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AssistantFileResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = AssistantFileListResponse::from(assistantFileListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = AssistantFileListResponse::from(assistantFileListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(assistantFileListResource());
});

test('fake', function () {
    $response = AssistantFileListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS');
});

test('fake with override', function () {
    $response = AssistantFileListResponse::fake([
        'data' => [
            [
                'id' => 'file-1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('file-1234');
});
