<?php

use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;

test('from', function () {
    $completion = CreateResponse::from(chatCompletion());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('as array accessible', function () {
    $completion = CreateResponse::from(chatCompletion());

    expect($completion['id'])->toBe('chatcmpl-123');
});

test('to array', function () {
    $completion = CreateResponse::from(chatCompletion());

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(chatCompletion());
});
