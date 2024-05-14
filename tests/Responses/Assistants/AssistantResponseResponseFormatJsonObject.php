<?php

use OpenAI\Responses\Assistants\AssistantResponseResponseFormatJsonObject;

test('from', function () {
    $result = AssistantResponseResponseFormatJsonObject::from(assistantWithJsonObjectResponseFormat()['response_format']);

    expect($result)
        ->type->toBe('json_object');
});

test('as array accessible', function () {
    $result = AssistantResponseResponseFormatJsonObject::from(assistantWithJsonObjectResponseFormat()['response_format']);

    expect($result['type'])
        ->toBe('json_object');
});

test('to array', function () {
    $result = AssistantResponseResponseFormatJsonObject::from(assistantWithJsonObjectResponseFormat()['response_format']);

    expect($result->toArray())
        ->toBe(assistantWithJsonObjectResponseFormat()['response_format']);
});
