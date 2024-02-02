<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseUsage;

test('from', function () {
    $result = ThreadRunResponseUsage::from(threadRunWithUsageResource()['usage']);

    expect($result)
        ->promptTokens->toBe(1)
        ->completionTokens->toBe(16)
        ->totalTokens->toBe(17);
});

test('to array', function () {
    $result = ThreadRunResponseUsage::from(completion()['usage']);

    expect($result->toArray())
        ->toBe(completion()['usage']);
});
