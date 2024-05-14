<?php

use OpenAI\Responses\Assistants\AssistantResponseResponseFormatText;

test('from', function () {
    $result = AssistantResponseResponseFormatText::from(assistantWithTextResponseFormat()['response_format']);

    expect($result)
        ->type->toBe('text');
});

test('as array accessible', function () {
    $result = AssistantResponseResponseFormatText::from(assistantWithTextResponseFormat()['response_format']);

    expect($result['type'])
        ->toBe('text');
});

test('to array', function () {
    $result = AssistantResponseResponseFormatText::from(assistantWithTextResponseFormat()['response_format']);

    expect($result->toArray())
        ->toBe(assistantWithTextResponseFormat()['response_format']);
});
