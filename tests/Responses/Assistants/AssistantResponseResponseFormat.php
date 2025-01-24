<?php

use OpenAI\Responses\Assistants\AssistantResponseResponseFormat;

test('from', function () {
    $result = AssistantResponseResponseFormat::from(assistantWithJsonObjectResponseFormat()['response_format']);

    expect($result)
        ->type->toBe('json_object');
});

test('as array accessible', function () {
    $result = AssistantResponseResponseFormat::from(assistantWithJsonObjectResponseFormat()['response_format']);

    expect($result['type'])
        ->toBe('json_object');
});

test('to array', function () {
    $result = AssistantResponseResponseFormat::from(assistantWithJsonObjectResponseFormat()['response_format']);

    expect($result->toArray())
        ->toBe(assistantWithJsonObjectResponseFormat()['response_format']);
});
