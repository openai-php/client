<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreter;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputImage;

test('from', function () {
    $result = ThreadRunStepResponseCodeInterpreter::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']);
    expect($result)
        ->input->toBe('The input string.')
        ->outputs->toBeArray()
        ->outputs->{0}->toBeInstanceOf(ThreadRunStepResponseCodeInterpreterOutputImage::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseCodeInterpreter::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']);

    expect($result['input'])
        ->toBe('The input string.');
});

test('to array', function () {
    $result = ThreadRunStepResponseCodeInterpreter::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']);
});
