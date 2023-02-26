<?php

use OpenAI\Responses\Completions\CreateResponseChoice;
use OpenAI\Responses\Completions\CreateResponseChoiceLogprobs;

test('from', function () {
    $result = CreateResponseChoice::from(completion()['choices'][0]);

    expect($result)
        ->text->toBe("el, she elaborates more on the Corruptor's role, suggesting K")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeIn(['length', null]);
});

test('to array', function () {
    $result = CreateResponseChoice::from(completion()['choices'][0]);

    expect($result->toArray())
        ->toBe(completion()['choices'][0]);
});

test('from with logprobs', function () {
    $result = CreateResponseChoice::from(completionWithLogprobs()['choices'][0]);

    expect($result)
        ->text->toBe('PHP is')
        ->index->toBe(0)
        ->logprobs->toBeInstanceOf(CreateResponseChoiceLogprobs::class)
        ->finishReason->toBeIn(['length', null]);
});

test('to array with logprobs', function () {
    $result = CreateResponseChoice::from(completionWithLogprobs()['choices'][0]);

    expect($result->toArray())
        ->toBe(completionWithLogprobs()['choices'][0]);
});
