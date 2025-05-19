<?php

use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseMessage;

test('from', function () {
    $result = CreateResponseChoice::from(chatCompletion()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->finishReason->toBeIn(['stop', null]);
});

test('from vision response', function () {
    $result = CreateResponseChoice::from(chatCompletionFromVision()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->finishReason->toBeNull();
});

test('from OpenRouter OpenAI response', function () {
    $result = CreateResponseChoice::from(chatCompletionOpenRouterOpenAI()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->logprobs->toBeNull()
        ->finishReason->toBe('stop');
});

test('from OpenRouter Google response', function () {
    $result = CreateResponseChoice::from(chatCompletionOpenRouterGoogle()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->logprobs->toBeNull()
        ->finishReason->toBe('stop');
});

test('from OpenRouter xAI response', function () {
    $result = CreateResponseChoice::from(chatCompletionOpenRouterXAI()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->message->toBeInstanceOf(CreateResponseMessage::class)
        ->logprobs->toBeNull()
        ->finishReason->toBe('stop');
});

test('to array', function () {
    $result = CreateResponseChoice::from(chatCompletion()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletion()['choices'][0]);
});
