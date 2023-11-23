<?php

use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = AssistantListResponse::from(assistantListResource(), meta());

    expect($response)
        ->toBeInstanceOf(AssistantListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AssistantResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = AssistantListResponse::from(assistantListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = AssistantListResponse::from(assistantListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(assistantListResource());
});

test('fake', function () {
    $response = AssistantListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('fake with override', function () {
    $response = AssistantListResponse::fake([
        'data' => [
            [
                'id' => 'asst_1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('asst_1234');
});
