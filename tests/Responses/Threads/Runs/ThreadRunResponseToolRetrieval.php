<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseFileSearch;

test('from', function () {
    $result = ThreadRunResponseFileSearch::from(threadRunWithRetrievalToolResource()['tools'][0]);

    expect($result)
        ->type->toBe('file_search');
});

test('as array accessible', function () {
    $result = ThreadRunResponseFileSearch::from(threadRunWithRetrievalToolResource()['tools'][0]);

    expect($result['type'])
        ->toBe('file_search');
});

test('to array', function () {
    $result = ThreadRunResponseFileSearch::from(threadRunWithRetrievalToolResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(threadRunWithRetrievalToolResource()['tools'][0]);
});
