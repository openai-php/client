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

test('from vision chunk', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamVisionContentChunk()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->delta->toBeInstanceOf(CreateStreamedResponseDelta::class)
        ->finishReason->toBeNull();
});

test('from with finish reason', function () {
    $data = chatCompletionStreamFirstChunk()['choices'][0];
    $data['finish_reason'] = 'stop';

    $result = CreateStreamedResponseChoice::from($data);

    expect($result)
        ->index->toBe(0)
        ->delta->toBeInstanceOf(CreateStreamedResponseDelta::class)
        ->finishReason->toBe('stop');
});

test('to array', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamFirstChunk()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionStreamFirstChunk()['choices'][0]);
});
