<?php

use OpenAI\Responses\Assistants\AssistantResponseToolResourceFileSearch;

test('from', function () {
    $result = AssistantResponseToolResourceFileSearch::from(assistantWithToolResources()['tool_resources']['file_search']);

    expect($result)
        ->vectorStoreIds->toBeArray()->toHaveLength(1);
});

test('as array accessible', function () {
    $result = AssistantResponseToolResourceFileSearch::from(assistantWithToolResources()['tool_resources']['file_search']);

    expect($result['vector_store_ids'])
        ->toBeArray()->toHaveLength(1);
});

test('to array', function () {
    $result = AssistantResponseToolResourceFileSearch::from(assistantWithToolResources()['tool_resources']['file_search']);

    expect($result->toArray())
        ->toBe(assistantWithToolResources()['tool_resources']['file_search']);
});
