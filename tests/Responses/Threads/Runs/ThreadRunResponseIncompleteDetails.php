<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseIncompleteDetails;

test('from', function () {
    $result = ThreadRunResponseIncompleteDetails::from(threadRunWithIncompleteDetails()['incomplete_details']);
    expect($result)
        ->reason->toBe('Input tokens exceeded');
});

test('as array accessible', function () {
    $result = ThreadRunResponseIncompleteDetails::from(threadRunWithIncompleteDetails()['incomplete_details']);

    expect($result['reason'])
        ->toBe('Input tokens exceeded');
});

test('to array', function () {
    $result = ThreadRunResponseIncompleteDetails::from(threadRunWithIncompleteDetails()['incomplete_details']);

    expect($result->toArray())
        ->toBe(threadRunWithIncompleteDetails()['incomplete_details']);
});
