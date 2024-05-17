<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolRetrieval;

test('from', function () {
    $result = ThreadRunResponseToolRetrieval::from(threadRunWithRetrievalToolResource()['tools'][0]);

    expect($result)
        ->type->toBe('file_search');
});

test('as array accessible', function () {
    $result = ThreadRunResponseToolRetrieval::from(threadRunWithRetrievalToolResource()['tools'][0]);

    expect($result['type'])
        ->toBe('file_search');
});

test('to array', function () {
    $result = ThreadRunResponseToolRetrieval::from(threadRunWithRetrievalToolResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(threadRunWithRetrievalToolResource()['tools'][0]);
});
