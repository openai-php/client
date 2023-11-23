<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolFunction;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolFunctionFunction;

test('from', function () {
    $result = ThreadRunResponseToolFunction::from(threadRunWithSubmitToolOutputsResource()['tools'][0]);

    expect($result)
        ->type->toBe('function')
        ->function->toBeInstanceOf(ThreadRunResponseToolFunctionFunction::class);
});

test('as array accessible', function () {
    $result = ThreadRunResponseToolFunction::from(threadRunWithSubmitToolOutputsResource()['tools'][0]);

    expect($result['type'])
        ->toBe('function');
});

test('to array', function () {
    $result = ThreadRunResponseToolFunction::from(threadRunWithSubmitToolOutputsResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(threadRunWithSubmitToolOutputsResource()['tools'][0]);
});
