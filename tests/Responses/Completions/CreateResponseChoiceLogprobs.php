<?php

use OpenAI\Responses\Completions\CreateResponseChoiceLogprobs;

test('from', function () {
    $result = CreateResponseChoiceLogprobs::from(completionWithLogprobs()['choices'][0]['logprobs']);

    expect($result)
        ->tokens->toBeArray()->toHaveCount(3)
        ->tokens->{0}->toBe('PH')
        ->tokenLogprobs->toBeArray()->toHaveCount(3)
        ->tokenLogprobs->{0}->toBeNull()
        ->topLogprobs->toBeNull()
        ->textOffset->toBeArray()->toHaveCount(3)
        ->textOffset->{0}->toBe(0);
});

test('to array', function () {
    $result = CreateResponseChoiceLogprobs::from(completionWithLogprobs()['choices'][0]['logprobs']);

    expect($result->toArray())
        ->toBe(completionWithLogprobs()['choices'][0]['logprobs']);
});
