<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredAction;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredActionSubmitToolOutputs;

test('from', function () {
    $result = ThreadRunResponseRequiredAction::from(threadRunWithSubmitToolOutputsResource()['required_action']);

    expect($result)
        ->type->toBe('submit_tool_outputs')
        ->submitToolOutputs->toBeInstanceOf(ThreadRunResponseRequiredActionSubmitToolOutputs::class);
});

test('as array accessible', function () {
    $result = ThreadRunResponseRequiredAction::from(threadRunWithSubmitToolOutputsResource()['required_action']);

    expect($result['type'])
        ->toBe('submit_tool_outputs');
});

test('to array', function () {
    $result = ThreadRunResponseRequiredAction::from(threadRunWithSubmitToolOutputsResource()['required_action']);

    expect($result->toArray())
        ->toBe(threadRunWithSubmitToolOutputsResource()['required_action']);
});
