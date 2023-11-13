<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredActionFunctionToolCall;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredActionSubmitToolOutputs;

test('from', function () {
    $result = ThreadRunResponseRequiredActionSubmitToolOutputs::from(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']);

    expect($result)
        ->toolCalls->toBeArray()
        ->toolCalls->toHaveCount(1)
        ->toolCalls->{0}->toBeInstanceOf(ThreadRunResponseRequiredActionFunctionToolCall::class);
});

test('as array accessible', function () {
    $result = ThreadRunResponseRequiredActionSubmitToolOutputs::from(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']);

    expect($result['tool_calls'][0]['type'])
        ->toBe('function');
});

test('to array', function () {
    $result = ThreadRunResponseRequiredActionSubmitToolOutputs::from(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']);

    expect($result->toArray())
        ->toBe(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']);
});
