<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputLogs;

test('from', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputLogs::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][1]);
    expect($result)
        ->type->toBe('logs')
        ->logs->toBe('The log output content.');
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputLogs::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][1]);

    expect($result['type'])
        ->toBe('logs');
});

test('to array', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputLogs::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][1]);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][1]);
});
