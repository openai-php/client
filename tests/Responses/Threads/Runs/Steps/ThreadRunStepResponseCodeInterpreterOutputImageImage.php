<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputImageImage;

test('from', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputImageImage::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]['image']);
    expect($result)
        ->fileId->toBe('file-6EsV79Y261TEmi0PY5iHbZdS');
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputImageImage::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]['image']);

    expect($result['file_id'])
        ->toBe('file-6EsV79Y261TEmi0PY5iHbZdS');
});

test('to array', function () {
    $result = ThreadRunStepResponseCodeInterpreterOutputImageImage::from(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]['image']);

    expect($result->toArray())
        ->toBe(threadRunStepWithCodeInterpreterOutputResource()['step_details']['tool_calls'][0]['code_interpreter']['outputs'][0]['image']);
});
