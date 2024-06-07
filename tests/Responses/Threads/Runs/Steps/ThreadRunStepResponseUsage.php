<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseUsage;

test('from', function () {
    $result = ThreadRunStepResponseUsage::from(threadRunStepResource()['usage']);
    expect($result)
        ->promptTokens->toBe(123)
        ->completionTokens->toBe(456)
        ->totalTokens->toBe(579);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseUsage::from(threadRunStepResource()['usage']);

    expect($result['prompt_tokens'])
        ->toBe(123);
});

test('to array', function () {
    $result = ThreadRunStepResponseUsage::from(threadRunStepResource()['usage']);

    expect($result->toArray())
        ->toBe(threadRunStepResource()['usage']);
});
