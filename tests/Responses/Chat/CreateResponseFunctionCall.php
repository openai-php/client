<?php

use OpenAI\Responses\Chat\CreateResponseFunctionCall;

test('from', function () {
    $result = CreateResponseFunctionCall::from(chatCompletionWithFunction()['choices'][0]['message']['function_call']);

    expect($result)
        ->name->toBe('get_current_weather')
        ->arguments->toBe("{\n  \"location\": \"Boston, MA\"\n}");
});

test('to array', function () {
    $result = CreateResponseFunctionCall::from(chatCompletionWithFunction()['choices'][0]['message']['function_call']);

    expect($result->toArray())
        ->toBe(chatCompletionWithFunction()['choices'][0]['message']['function_call']);
});
