<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolFunctionFunction;

test('from', function () {
    $result = ThreadRunResponseToolFunctionFunction::from(threadRunWithSubmitToolOutputsResource()['tools'][0]['function']);

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
    $result = ThreadRunResponseToolFunctionFunction::from(threadRunWithSubmitToolOutputsResource()['tools'][0]['function']);

    expect($result['name'])
        ->toBe('add');
});

test('to array', function () {
    $result = ThreadRunResponseToolFunctionFunction::from(threadRunWithSubmitToolOutputsResource()['tools'][0]['function']);

    expect($result->toArray())
        ->toBe(threadRunWithSubmitToolOutputsResource()['tools'][0]['function']);
});
