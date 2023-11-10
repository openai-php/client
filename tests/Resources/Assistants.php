<?php

use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\Responses\Assistants\AssistantResponseToolCodeInterpreter;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'assistants', [], Response::from(assistantListResource(), metaHeaders()));

    $result = $client->assistants()->list();

    expect($result)
        ->toBeInstanceOf(AssistantListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AssistantResponse::class)
        ->firstId->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->lastId->toBe('asst_y49lAdZDiaQUxEBR6zrG846Q')
        ->hasMore->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'assistants', [
        'instructions' => 'You are a personal math tutor.',
        'name' => 'Math Tutor',
        'tools' => [['type' => 'code_interpreter']],
        'model' => 'gpt-4',
    ], Response::from(assistantResource(), metaHeaders()));

    $result = $client->assistants()->create([
        'instructions' => 'You are a personal math tutor.',
        'name' => 'Math Tutor',
        'tools' => [['type' => 'code_interpreter']],
        'model' => 'gpt-4',
    ]);

    expect($result)
        ->toBeInstanceOf(AssistantResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant')
        ->createdAt->toBe(1699619403)
        ->name->toBe('Math Tutor')
        ->description->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(AssistantResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toBeEmpty()
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('modify', function () {
    $client = mockClient('POST', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc', [
        'name' => 'Math Tutors',
    ], Response::from(assistantResource(), metaHeaders()));

    $result = $client->assistants()->modify('asst_SMzoVX8XmCZEg1EbMHoAm8tc', [
        'name' => 'Math Tutors',
    ]);

    expect($result)
        ->toBeInstanceOf(AssistantResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant')
        ->createdAt->toBe(1699619403)
        ->name->toBe('Math Tutor')
        ->description->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(AssistantResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toBeEmpty()
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc', [], Response::from(assistantResource(), metaHeaders()));

    $result = $client->assistants()->retrieve('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    expect($result)
        ->toBeInstanceOf(AssistantResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant')
        ->createdAt->toBe(1699619403)
        ->name->toBe('Math Tutor')
        ->description->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(AssistantResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toBeEmpty()
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'assistants/asst_SMzoVX8XmCZEg1EbMHoAm8tc', [], Response::from(assistantDeleteResource(), metaHeaders()));

    $result = $client->assistants()->delete('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    expect($result)
        ->toBeInstanceOf(AssistantDeleteResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('assistant.deleted')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
