<?php

use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\CreateStreamedResponseChoice;

test('from', function () {
    $completion = CreateStreamedResponse::from(chatCompletionStreamFirstChunk());

    expect($completion)
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz')
        ->object->toBe('chat.completion.chunk')
        ->created->toBe(1679432086)
        ->model->toBe('gpt-4-0314')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateStreamedResponseChoice::class);
});

test('from usage chunk', function () {
    $completion = CreateStreamedResponse::from(chatCompletionStreamUsageChunk());

    expect($completion)
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz')
        ->object->toBe('chat.completion.chunk')
        ->created->toBe(1679432086)
        ->model->toBe('gpt-4-0314')
        ->choices->toBeArray()->toHaveCount(0)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->usage->promptTokens->toBe(9)
        ->usage->completionTokens->toBe(12)
        ->usage->totalTokens->toBe(21);
});

test('as array accessible', function () {
    $completion = CreateStreamedResponse::from(chatCompletionStreamFirstChunk());

    expect($completion['id'])->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz');
});

test('to array', function () {
    $completion = CreateStreamedResponse::from(chatCompletionStreamFirstChunk());

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(chatCompletionStreamFirstChunk());
});

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current())
        ->id->toBe('chatcmpl-6yo21W6LVo8Tw2yBf7aGf2g17IeIl');
});

test('fake with override', function () {
    $response = CreateStreamedResponse::fake(chatCompletionStream());

    expect($response->getIterator()->current())
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz');
});
