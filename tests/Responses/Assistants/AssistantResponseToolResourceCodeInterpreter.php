<?php

use OpenAI\Responses\Assistants\AssistantResponseToolResourceCodeInterpreter;

test('from', function () {
    $result = AssistantResponseToolResourceCodeInterpreter::from(assistantWithCodeInterpreterResource()['tool_resources'][0]);

    expect($result)
        ->fileIds->toBeArray()->toHaveLength(1);
});

test('as array accessible', function () {
    $result = AssistantResponseToolResourceCodeInterpreter::from(assistantWithCodeInterpreterResource()['tool_resources'][0]);

    expect($result['file_ids'])
        ->toBeArray()->toHaveLength(1);
});

test('to array', function () {
    $result = AssistantResponseToolResourceCodeInterpreter::from(assistantWithCodeInterpreterResource()['tool_resources'][0]);

    expect($result->toArray())
        ->toBe(assistantWithCodeInterpreterResource()['tool_resources'][0]);
});
