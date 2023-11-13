<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseFunction;

test('from', function () {
    $result = ThreadRunStepResponseFunction::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]['function']);
    expect($result)
        ->name->toBe('add')
        ->arguments->toBe('{ "a": 5, "b": 7 }')
        ->output->toBe('12');
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseFunction::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]['function']);

    expect($result['name'])
        ->toBe('add');
});

test('to array', function () {
    $result = ThreadRunStepResponseFunction::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]['function']);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]['function']);
});
