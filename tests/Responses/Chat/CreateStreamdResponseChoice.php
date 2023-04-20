<?php

use OpenAI\Responses\Chat\CreateStreamedResponseChoice;
use OpenAI\Responses\Chat\CreateStreamedResponseDelta;

test('from', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamFirstChunk()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->delta->toBeInstanceOf(CreateStreamedResponseDelta::class)
        ->finishReason->toBeIn(['stop', null]);
});

test('to array', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamFirstChunk()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionStreamFirstChunk()['choices'][0]);
});
