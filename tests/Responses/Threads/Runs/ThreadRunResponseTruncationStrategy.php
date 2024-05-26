<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseTruncationStrategy;

test('from', function () {
    $result = ThreadRunResponseTruncationStrategy::from(threadRunResource()['truncation_strategy']);
    expect($result)
        ->type->toBe('auto')
        ->lastMessages->toBeNull();
});

test('as array accessible', function () {
    $result = ThreadRunResponseTruncationStrategy::from(threadRunResource()['truncation_strategy']);

    expect($result['type'])
        ->toBe('auto');
});

test('to array', function () {
    $result = ThreadRunResponseTruncationStrategy::from(threadRunResource()['truncation_strategy']);

    expect($result->toArray())
        ->toBe(threadRunResource()['truncation_strategy']);
});
