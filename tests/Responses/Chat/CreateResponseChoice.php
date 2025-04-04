<?php

use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseChoiceLogprobs;
use OpenAI\Responses\Chat\CreateResponseMessage;

test('from', function () {
    $result = CreateResponseChoice::from(chatCompletion()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->logprobs->toBeNull()
        ->finishReason->toBeIn(['stop', null]);
});

test('from with logprobs', function () {
    $result = CreateResponseChoice::from(chatCompletionWithLogprobs()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->logprobs->toBeInstanceOf(CreateResponseChoiceLogprobs::class)
        ->finishReason->toBeIn(['stop', null]);
});

test('from vision response', function () {
    $result = CreateResponseChoice::from(chatCompletionFromVision()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->logprobs->toBeNull()
        ->finishReason->toBeNull();
});

test('to array', function () {
    $result = CreateResponseChoice::from(chatCompletion()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletion()['choices'][0]);
});

test('to array with logprobs', function () {
    $result = CreateResponseChoice::from(chatCompletionWithLogprobs()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionWithLogprobs()['choices'][0]);
});
