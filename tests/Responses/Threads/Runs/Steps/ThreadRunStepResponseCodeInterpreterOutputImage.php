<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputImage;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputImageImage;

test('from', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputImage::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]);
    expect($result)
        ->type->toBe('image')
        ->image->toBeInstanceOf(ThreadRunStepResponseCodeInterpreterOutputImageImage::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputImage::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]);

    expect($result['type'])
        ->toBe('image');
});

test('to array', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputImage::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]);
});
