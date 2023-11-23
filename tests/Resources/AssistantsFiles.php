<?php

use OpenAI\Responses\Assistants\Files\AssistantFileDeleteResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileListResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc/files', [], Response::from(assistantFileListResource(), metaHeaders()));

    $result = $client->assistants()->files()->list('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    expect($result)
        ->toBeInstanceOf(AssistantFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AssistantFileResponse::class)
        ->firstId->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->lastId->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc/files', [
        'file_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
    ], Response::from(assistantFileResource(), metaHeaders()));

    $result = $client->assistants()->files()->create('asst_SMzoVX8XmCZEg1EbMHoAm8tc', [
        'file_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
    ]);

    expect($result)
        ->toBeInstanceOf(AssistantFileResponse::class)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->object->toBe('assistant.file')
        ->createdAt->toBe(1699620898)
        ->assistantId->toBe('asst_y49lAdZDiaQUxEBR6zrG846Q');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc/files/file-6EsV79Y261TEmi0PY5iHbZdS', [], Response::from(assistantFileResource(), metaHeaders()));

    $result = $client->assistants()->files()->retrieve('asst_SMzoVX8XmCZEg1EbMHoAm8tc', 'file-6EsV79Y261TEmi0PY5iHbZdS');

    expect($result)
        ->toBeInstanceOf(AssistantFileResponse::class)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->object->toBe('assistant.file')
        ->createdAt->toBe(1699620898)
        ->assistantId->toBe('asst_y49lAdZDiaQUxEBR6zrG846Q');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc/files/file-6EsV79Y261TEmi0PY5iHbZdS', [], Response::from(assistantFileDeleteResource(), metaHeaders()));

    $result = $client->assistants()->files()->delete('asst_SMzoVX8XmCZEg1EbMHoAm8tc', 'file-6EsV79Y261TEmi0PY5iHbZdS');

    expect($result)
        ->toBeInstanceOf(AssistantFileDeleteResponse::class)
        ->id->toBe('file-6EsV79Y261TEmi0PY5iHbZdS')
        ->object->toBe('assistant.file.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
