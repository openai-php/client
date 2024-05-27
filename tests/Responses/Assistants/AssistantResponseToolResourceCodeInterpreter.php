<?php

use OpenAI\Responses\Assistants\AssistantResponseToolResourceCodeInterpreter;

test('from', function () {
    $result = AssistantResponseToolResourceCodeInterpreter::from(assistantWithToolResources()['tool_resources']['code_interpreter']);

    expect($result)
        ->fileIds->toBeArray()->toHaveLength(1);
});

test('as array accessible', function () {
    $result = AssistantResponseToolResourceCodeInterpreter::from(assistantWithToolResources()['tool_resources']['code_interpreter']);

    expect($result['file_ids'])
        ->toBeArray()->toHaveLength(1);
});

test('to array', function () {
    $result = AssistantResponseToolResourceCodeInterpreter::from(assistantWithToolResources()['tool_resources']['code_interpreter']);

    expect($result->toArray())
        ->toBe(assistantWithToolResources()['tool_resources']['code_interpreter']);
});
