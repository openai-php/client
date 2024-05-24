<?php

use OpenAI\Responses\VectorStores\VectorStoreResponseFileCounts;

test('from', function () {
    $result = VectorStoreResponseFileCounts::from(vectorStoreResource()['file_counts']);

    expect($result)
        ->inProgress->toBe(0)
        ->completed->toBe(1)
        ->failed->toBe(0)
        ->cancelled->toBe(0)
        ->total->toBe(1);
});

test('as array accessible', function () {
    $result = VectorStoreResponseFileCounts::from(vectorStoreResource()['file_counts']);

    expect($result['total'])
        ->toBe(1);
});

test('to array', function () {
    $result = VectorStoreResponseFileCounts::from(vectorStoreResource()['file_counts']);

    expect($result->toArray())
        ->toBe(vectorStoreResource()['file_counts']);
});
