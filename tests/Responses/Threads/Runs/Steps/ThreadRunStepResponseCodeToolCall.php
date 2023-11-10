<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreter;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeToolCall;

test('from', function () {
    $result = ThreadRunStepResponseCodeToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]);
    expect($result)
        ->id->toBe('call_KSg14X7kZF2WDzlPhpQ168Mj')
        ->type->toBe('code_interpreter')
        ->codeInterpreter->toBeInstanceOf(ThreadRunStepResponseCodeInterpreter::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseCodeToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]);

    expect($result['id'])
        ->toBe('call_KSg14X7kZF2WDzlPhpQ168Mj');
});

test('to array', function () {
    $result = ThreadRunStepResponseCodeToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]);
});
