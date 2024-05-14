<?php

use OpenAI\Responses\Assistants\AssistantResponseToolResourceFileSearch;

test('from', function () {
    $result = AssistantResponseToolResourceFileSearch::from(assistantWithFileSearchResource()['tool_resources'][0]);

    expect($result)
        ->vectorStoreIds->toBeArray()->toHaveLength(1);
});

test('as array accessible', function () {
    $result = AssistantResponseToolResourceFileSearch::from(assistantWithFileSearchResource()['tool_resources'][0]);

    expect($result['vector_store_ids'])
        ->toBeArray()->toHaveLength(1);
});

test('to array', function () {
    $result = AssistantResponseToolResourceFileSearch::from(assistantWithFileSearchResource()['tool_resources'][0]);

    expect($result->toArray())
        ->toBe(assistantWithFileSearchResource()['tool_resources'][0]);
});
