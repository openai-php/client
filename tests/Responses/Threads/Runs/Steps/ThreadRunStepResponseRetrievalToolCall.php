<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseRetrievalToolCall;

test('from', function () {
    $result = ThreadRunStepResponseRetrievalToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);
    expect($result)
        ->id->toBe('call_mNs14X7kZF2WDzlPhpQ163Co')
        ->type->toBe('retrieval')
        ->retrieval->toBe([]);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseRetrievalToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);

    expect($result['id'])
        ->toBe('call_mNs14X7kZF2WDzlPhpQ163Co');
});

test('to array', function () {
    $result = ThreadRunStepResponseRetrievalToolCall::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][2]);
});
