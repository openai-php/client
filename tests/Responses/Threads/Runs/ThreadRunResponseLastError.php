<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseLastError;

test('from', function () {
    $result = ThreadRunResponseLastError::from(threadRunWithLasErrorResource()['last_error']);

    expect($result)
        ->code->toBe('rate_limit_exceeded');
});

test('as array accessible', function () {
    $result = ThreadRunResponseLastError::from(threadRunWithLasErrorResource()['last_error']);

    expect($result['code'])
        ->toBe('rate_limit_exceeded');
});

test('to array', function () {
    $result = ThreadRunResponseLastError::from(threadRunWithLasErrorResource()['last_error']);

    expect($result->toArray())
        ->toBe(threadRunWithLasErrorResource()['last_error']);
});
