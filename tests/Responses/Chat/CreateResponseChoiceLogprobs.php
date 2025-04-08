<?php

use OpenAI\Responses\Chat\CreateResponseChoiceLogprobs;
use OpenAI\Responses\Chat\CreateResponseChoiceLogprobsContent;

test('from', function () {
    $result = CreateResponseChoiceLogprobs::from(chatCompletionWithLogprobs()['choices'][0]['logprobs']);

    expect($result)
        ->toBeInstanceOf(CreateResponseChoiceLogprobs::class)
        ->content->toBeArray()
        ->content->toHaveCount(2)
        ->content->each->toBeInstanceOf(CreateResponseChoiceLogprobsContent::class);
});

test('to array', function () {
    $result = CreateResponseChoiceLogprobs::from(chatCompletionWithLogprobs()['choices'][0]['logprobs']);

    expect($result->toArray())
        ->toBe(chatCompletionWithLogprobs()['choices'][0]['logprobs']);
});
