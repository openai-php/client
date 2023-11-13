<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredActionFunctionToolCallFunction;

test('from', function () {
    $result = ThreadRunResponseRequiredActionFunctionToolCallFunction::from(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']['tool_calls'][0]['function']);

    expect($result)
        ->name->toBe('add')
        ->arguments->toBe('{ "a": 5, "b": 7 }');
});

test('as array accessible', function () {
    $result = ThreadRunResponseRequiredActionFunctionToolCallFunction::from(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']['tool_calls'][0]['function']);

    expect($result['name'])
        ->toBe('add');
});

test('to array', function () {
    $result = ThreadRunResponseRequiredActionFunctionToolCallFunction::from(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']['tool_calls'][0]['function']);

    expect($result->toArray())
        ->toBe(threadRunWithSubmitToolOutputsResource()['required_action']['submit_tool_outputs']['tool_calls'][0]['function']);
});
