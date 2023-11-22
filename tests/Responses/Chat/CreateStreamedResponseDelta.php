<?php

use OpenAI\Responses\Chat\CreateStreamedResponseDelta;
use OpenAI\Responses\Chat\CreateStreamedResponseFunctionCall;
use OpenAI\Responses\Chat\CreateStreamedResponseToolCall;

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

test('from tool calls chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamToolCallsChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBeNull()
        ->content->toBeNull()
        ->toolCalls->toBeArray()
        ->toolCalls->toHaveCount(1)
        ->toolCalls->each->toBeInstanceOf(CreateStreamedResponseToolCall::class);
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

test('to array for a tool calls chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamToolCallsChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamToolCallsChunk()['choices'][0]['delta']);
});

test('to array for a tool calls chunk without tool id', function () {
    $data = chatCompletionStreamToolCallsChunk()['choices'][0]['delta'];
    unset($data['tool_calls'][0]['id']);

    $result = CreateStreamedResponseDelta::from($data);

    expect($result->toArray())
        ->toBe($data);
});

test('to array for a tool calls chunk without function name', function () {
    $data = chatCompletionStreamToolCallsChunk()['choices'][0]['delta'];
    unset($data['tool_calls'][0]['function']['name']);

    $result = CreateStreamedResponseDelta::from($data);

    expect($result->toArray())
        ->toBe($data);
});
