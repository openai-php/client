<?php

use OpenAI\Responses\Assistants\AssistantResponseToolFunctionFunction;

test('from', function () {
    $result = AssistantResponseToolFunctionFunction::from(assistantWithFunctionToolResource()['tools'][0]['function']);

    expect($result)
        ->name->toBe('add')
        ->description->toBe('Returns the sum of two numbers')
        ->parameters->toBe([
            'type' => 'object',
            'properties' => [
                'a' => [
                    'type' => 'number',
                ],
                'b' => [
                    'type' => 'number',
                ],
            ],
            'required' => [
                'a',
                'b',
            ],
        ]);
});

test('as array accessible', function () {
    $result = AssistantResponseToolFunctionFunction::from(assistantWithFunctionToolResource()['tools'][0]['function']);

    expect($result['name'])
        ->toBe('add');
});

test('to array', function () {
    $result = AssistantResponseToolFunctionFunction::from(assistantWithFunctionToolResource()['tools'][0]['function']);

    expect($result->toArray())
        ->toBe(assistantWithFunctionToolResource()['tools'][0]['function']);
});
