<?php

use OpenAI\Responses\Assistants\AssistantResponseToolRetrieval;

test('from', function () {
    $result = AssistantResponseToolRetrieval::from(assistantWithRetrievalToolResource()['tools'][0]);

    expect($result)
        ->type->toBe('file_search');
});

test('as array accessible', function () {
    $result = AssistantResponseToolRetrieval::from(assistantWithRetrievalToolResource()['tools'][0]);

    expect($result['type'])
        ->toBe('file_search');
});

test('to array', function () {
    $result = AssistantResponseToolRetrieval::from(assistantWithRetrievalToolResource()['tools'][0]);

    expect($result->toArray())
        ->toBe(assistantWithRetrievalToolResource()['tools'][0]);
});
