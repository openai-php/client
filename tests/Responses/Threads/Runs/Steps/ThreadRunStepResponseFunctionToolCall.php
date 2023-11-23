<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseFunction;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseFunctionToolCall;

test('from', function () {
    $result = ThreadRunStepResponseFunctionToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]);
    expect($result)
        ->id->toBe('call_Fbg14X7kZF2WDzlPhpQ167De')
        ->type->toBe('function')
        ->function->toBeInstanceOf(ThreadRunStepResponseFunction::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseFunctionToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]);

    expect($result['id'])
        ->toBe('call_Fbg14X7kZF2WDzlPhpQ167De');
});

test('to array', function () {
    $result = ThreadRunStepResponseFunctionToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][1]);
});
