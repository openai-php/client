<?php

use OpenAI\Responses\Assistants\AssistantResponseToolFileSearch;

test('from', function () {
    $result = AssistantResponseToolFileSearch::from(assistantWithFileSearchResource()['tools'][0]);

    expect($result)
        ->type->toBe('file_search');
});

test('as array accessible', function () {
    $result = AssistantResponseToolFileSearch::from(assistantWithFileSearchResource()['tools'][0]);

    expect($result['type'])
        ->toBe('file_search');
});

test('to array', function () {
    $result = AssistantResponseToolFileSearch::from(assistantWithFileSearchResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(assistantWithFileSearchResource()['tools'][0]);
});
