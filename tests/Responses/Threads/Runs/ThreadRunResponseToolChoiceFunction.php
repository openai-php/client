<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolChoiceFunction;

test('from', function () {
    $result = ThreadRunResponseToolChoiceFunction::from(threadRunWithToolChoiceFunction()['tool_choice']['function']);

    expect($result)
        ->name->toBe('calculate_sum');
});

test('as array accessible', function () {
    $result = ThreadRunResponseToolChoiceFunction::from(threadRunWithToolChoiceFunction()['tool_choice']['function']);

    expect($result['name'])
        ->toBe('calculate_sum');
});

test('to array', function () {
    $result = ThreadRunResponseToolChoiceFunction::from(threadRunWithToolChoiceFunction()['tool_choice']['function']);

    expect($result->toArray())
        ->toBe(threadRunWithToolChoiceFunction()['tool_choice']['function']);
});
