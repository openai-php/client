<?php

use OpenAI\Responses\Assistants\AssistantResponseToolCodeInterpreter;

test('from', function () {
    $result = AssistantResponseToolCodeInterpreter::from(assistantResource()['tools'][0]);

    expect($result)
        ->type->toBe('code_interpreter');
});

test('as array accessible', function () {
    $result = AssistantResponseToolCodeInterpreter::from(assistantResource()['tools'][0]);

    expect($result['type'])
        ->toBe('code_interpreter');
});

test('to array', function () {
    $result = AssistantResponseToolCodeInterpreter::from(assistantResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(assistantResource()['tools'][0]);
});
