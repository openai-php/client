<?php

use OpenAI\Responses\Assistants\AssistantResponseToolFunction;
use OpenAI\Responses\Assistants\AssistantResponseToolFunctionFunction;

test('from', function () {
    $result = AssistantResponseToolFunction::from(assistantWithFunctionToolResource()['tools'][0]);

    expect($result)
        ->type->toBe('function')
        ->function->toBeInstanceOf(AssistantResponseToolFunctionFunction::class);
});

test('to array', function () {
    $result = AssistantResponseToolFunction::from(assistantWithFunctionToolResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(assistantWithFunctionToolResource()['tools'][0]);
});
