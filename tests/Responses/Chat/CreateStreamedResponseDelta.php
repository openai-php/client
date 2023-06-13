<?php

use OpenAI\Responses\Chat\CreateStreamedResponseDelta;
use OpenAI\Responses\Chat\CreateStreamedResponseFunctionCall;

test('from first chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamFirstChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBeNull();
});

test('from content chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamContentChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBeNull()
        ->content->toBe('Hello')
        ->functionCall->toBeNull();
});

test('from function call chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamFunctionCallChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBeNull()
        ->content->toBeNull()
        ->functionCall->toBeInstanceOf(CreateStreamedResponseFunctionCall::class);
});

test('to array from first chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamFirstChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamFirstChunk()['choices'][0]['delta']);
});

test('to array for a content chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamContentChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamContentChunk()['choices'][0]['delta']);
});

test('to array for a function call chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamFunctionCallChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamFunctionCallChunk()['choices'][0]['delta']);
});
