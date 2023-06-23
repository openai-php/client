<?php

use OpenAI\Responses\Chat\CreateResponseFunctionCall;
use OpenAI\Responses\Chat\CreateResponseMessage;

test('from', function () {
    $result = CreateResponseMessage::from(chatCompletion()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBe("\n\nHello there, how may I assist you today?")
        ->functionCall->toBeNull();
});

test('from function response', function () {
    $result = CreateResponseMessage::from(chatCompletionWithFunction()['choices'][0]['message']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBeNull()
        ->functionCall->toBeInstanceOf(CreateResponseFunctionCall::class);
});

test('to array', function () {
    $result = CreateResponseMessage::from(chatCompletion()['choices'][0]['message']);

    expect($result->toArray())
        ->toBe(chatCompletion()['choices'][0]['message']);
});
