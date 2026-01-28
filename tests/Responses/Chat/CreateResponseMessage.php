<?php

use OpenAI\Responses\Chat\CreateResponseChoiceAnnotations;
use OpenAI\Responses\Chat\CreateResponseFunctionCall;
use OpenAI\Responses\Chat\CreateResponseMessage;
use OpenAI\Responses\Chat\CreateResponseToolCall;

test('from', function () {
    $result = CreateResponseMessage::from(chatCompletion()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBe("\n\nHello there, how may I assist you today?")
        ->annotations->toBeArray()
        ->functionCall->toBeNull();
});

test('from function response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithFunction()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBeNull()
        ->annotations->toBeArray()
        ->functionCall->toBeInstanceOf(CreateResponseFunctionCall::class);
});

test('from tool calls response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithToolCalls()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBeNull()
        ->toolCalls->toBeArray()
        ->toolCalls->toHaveCount(1)
        ->toolCalls->each->toBeInstanceOf(CreateResponseToolCall::class);
});

test('from annotations response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithAnnotations()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBe('Hello World')
        ->annotations->toBeArray()
        ->annotations->toHaveCount(1)
        ->annotations->each->toBeInstanceOf(CreateResponseChoiceAnnotations::class);
});

test('from function response without content', function () {
    $result = CreateResponseMessage::from(chatCompletionMessageWithFunctionAndNoContent());

    expect($result)
        ->role->toBe('assistant')
        ->content->toBeNull()
        ->functionCall->toBeInstanceOf(CreateResponseFunctionCall::class);
});

test('from reasoning', function () {
    $result = CreateResponseMessage::from(chatCompletionReasoningContent()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->reasoningContent->toBe('Hello world')
        ->annotations->toBeArray()
        ->functionCall->toBeNull();
});

test('to array', function () {
    $result = CreateResponseMessage::from(chatCompletionReasoningContent()['choices'][0]['message']);

    expect($result->toArray())
        ->toBe(chatCompletionReasoningContent()['choices'][0]['message']);
});

test('to array from reasoning', function () {
    $result = CreateResponseMessage::from(chatCompletion()['choices'][0]['message']);

    expect($result->toArray())
        ->toBe(chatCompletion()['choices'][0]['message']);
});

test('to array from function response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithFunction()['choices'][0]['message']);

    expect($result->toArray())
        ->toBe(chatCompletionWithFunction()['choices'][0]['message']);
});

test('to array from tool calls response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithToolCalls()['choices'][0]['message']);

    expect($result->toArray())
        ->toBe(chatCompletionWithToolCalls()['choices'][0]['message']);
});

test('to array from annotations response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithAnnotations()['choices'][0]['message']);

    expect($result->toArray())
        ->toBe(chatCompletionWithAnnotations()['choices'][0]['message']);
});
