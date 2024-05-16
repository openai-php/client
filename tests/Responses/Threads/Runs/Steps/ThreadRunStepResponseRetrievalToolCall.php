<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseFileSearchToolCall;

test('from', function () {
    $result = ThreadRunStepResponseFileSearchToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);
    expect($result)
        ->id->toBe('call_mNs14X7kZF2WDzlPhpQ163Co')
        ->type->toBe('file_search')
        ->file_search->toBe([]);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseFileSearchToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);

    expect($result['id'])
        ->toBe('call_mNs14X7kZF2WDzlPhpQ163Co');
});

test('to array', function () {
    $result = ThreadRunStepResponseFileSearchToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);
});
