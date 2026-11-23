<?php

use OpenAI\Responses\Chat\CreateResponseToolCall;
use OpenAI\Responses\Chat\CreateResponseToolCallCustom;
use OpenAI\Responses\Chat\CreateResponseToolCallFunction;

test('from', function () {
    $result = CreateResponseToolCall::from(chatCompletionWithToolCalls()['choices'][0]['message']['tool_calls'][0]);

    expect($result)
        ->id->toBe('call_trlgKnhMpYSC7CFXKw3CceUZ')
        ->type->toBe('function')
        ->function->toBeInstanceOf(CreateResponseToolCallFunction::class);
});

test('to array', function () {
    $result = CreateResponseToolCall::from(chatCompletionWithToolCalls()['choices'][0]['message']['tool_calls'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionWithToolCalls()['choices'][0]['message']['tool_calls'][0]);
});

test('from a custom tool call', function () {
    $result = CreateResponseToolCall::from(chatCompletionWithCustomToolCall()['choices'][0]['message']['tool_calls'][0]);

    expect($result)
        ->id->toBe('call_Hrb6BWd1ZW8VnnyJFdtR6dsv')
        ->type->toBe('custom')
        ->function->toBeNull()
        ->custom->toBeInstanceOf(CreateResponseToolCallCustom::class)
        ->custom->name->toBe('code_exec')
        ->custom->input->toBe('print("hello world")');
});

test('to array of a custom tool call', function () {
    $result = CreateResponseToolCall::from(chatCompletionWithCustomToolCall()['choices'][0]['message']['tool_calls'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionWithCustomToolCall()['choices'][0]['message']['tool_calls'][0]);
});
