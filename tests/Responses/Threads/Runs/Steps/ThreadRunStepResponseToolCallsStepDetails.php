<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeToolCall;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseToolCallsStepDetails;

test('from', function () {
    $result = ThreadRunStepResponseToolCallsStepDetails::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']);
    expect($result)
        ->type->toBe('tool_calls')
        ->toolCalls->toBeArray()
        ->toolCalls->{0}->toBeInstanceOf(ThreadRunStepResponseCodeToolCall::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseToolCallsStepDetails::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']);

    expect($result['type'])
        ->toBe('tool_calls');
});

test('to array', function () {
    $result = ThreadRunStepResponseToolCallsStepDetails::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']);
});
