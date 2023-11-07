<?php

use OpenAI\Responses\Chat\CreateResponseToolCallFunction;

test('from', function () {
    $result = CreateResponseToolCallFunction::from(chatCompletionWithToolCalls()['choices'][0]['message']['tool_calls'][0]['function']);

    expect($result)
        ->name->toBe('get_current_weather')
        ->arguments->toBe("{\n  \"location\": \"Boston, MA\"\n}");
});

test('to array', function () {
    $result = CreateResponseToolCallFunction::from(chatCompletionWithToolCalls()['choices'][0]['message']['tool_calls'][0]['function']);

    expect($result->toArray())
        ->toBe(chatCompletionWithToolCalls()['choices'][0]['message']['tool_calls'][0]['function']);
});
