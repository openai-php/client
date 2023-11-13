<?php

use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolCodeInterpreter;

test('from', function () {
    $result = ThreadRunResponseToolCodeInterpreter::from(threadRunResource()['tools'][0]);

    expect($result)
        ->type->toBe('code_interpreter');
});

test('as array accessible', function () {
    $result = ThreadRunResponseToolCodeInterpreter::from(threadRunResource()['tools'][0]);

    expect($result['type'])
        ->toBe('code_interpreter');
});

test('to array', function () {
    $result = ThreadRunResponseToolCodeInterpreter::from(threadRunResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(threadRunResource()['tools'][0]);
});
