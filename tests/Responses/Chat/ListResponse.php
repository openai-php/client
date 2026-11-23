<?php

use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\ListResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = ListResponse::from(chatCompletionList(), meta());

    expect($result)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponse::class)
        ->firstId->toBe('chatcmpl-123')
        ->lastId->toBe('chatcmpl-123')
        ->hasMore->toBeFalse()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ListResponse::from(chatCompletionList(), meta());

    expect($result['object'])->toBe('list');
});

test('to array', function () {
    $result = ListResponse::from(chatCompletionList(), meta());

    expect($result->toArray())
        ->toBe(chatCompletionList());
});

test('preserves stored completion metadata and custom tool calls', function () {
    $completion = chatCompletionWithCustomToolCall();
    $completion['metadata'] = ['source' => 'support'];
    $list = chatCompletionList();
    $list['data'] = [$completion];

    $result = ListResponse::from($list, meta());

    expect($result->data[0]->metadata)->toBe(['source' => 'support'])
        ->and($result->toArray())->toBe($list);
});

test('fake', function () {
    $response = ListResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->data->{0}->id->toBe('chatcmpl-123');
});

test('fake with override', function () {
    $response = ListResponse::fake([
        'has_more' => true,
    ]);

    expect($response)
        ->hasMore->toBeTrue();
});
