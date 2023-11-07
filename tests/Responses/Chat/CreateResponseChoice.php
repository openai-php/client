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

test('to array', function () {
    $result = CreateResponseChoice::from(chatCompletion()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletion()['choices'][0]);
});
