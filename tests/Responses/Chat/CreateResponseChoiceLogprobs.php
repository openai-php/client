<?php

use OpenAI\Responses\Chat\CreateResponseChoiceLogprobs;
use OpenAI\Responses\Chat\CreateResponseChoiceLogprobsContent;

test('from', function () {
    $result = CreateResponseChoiceLogprobs::from(chatCompletionWithLogprobs()['choices'][0]['logprobs']);

    expect($result)
        ->toBeInstanceOf(CreateResponseChoiceLogprobs::class)
        ->content->toBeArray()
        ->content->toHaveCount(2)
        ->content->each->toBeInstanceOf(CreateResponseChoiceLogprobsContent::class)
        ->refusal->toBeNull();
});

test('to array', function () {
    $result = CreateResponseChoiceLogprobs::from(chatCompletionWithLogprobs()['choices'][0]['logprobs']);

    expect($result->toArray())
        ->toBe(chatCompletionWithLogprobs()['choices'][0]['logprobs']);
});

test('from with refusal logprobs', function () {
    $attributes = chatCompletionWithLogprobs()['choices'][0]['logprobs'];
    $attributes['content'] = null;
    $attributes['refusal'] = [
        ['token' => 'No', 'logprob' => -0.1, 'bytes' => [78, 111], 'top_logprobs' => []],
    ];

    $result = CreateResponseChoiceLogprobs::from($attributes);

    expect($result)
        ->content->toBeNull()
        ->refusal->toHaveCount(1)
        ->refusal->each->toBeInstanceOf(CreateResponseChoiceLogprobsContent::class)
        ->and($result->toArray())->toBe($attributes);
});

test('from without top_logprobs and refusal', function () {
    $result = CreateResponseChoiceLogprobs::from([
        'content' => [['token' => 'Hi', 'logprob' => -0.2, 'bytes' => null]],
    ]);

    expect($result)
        ->refusal->toBeNull()
        ->content->{0}->topLogprobs->toBe([]);
});
