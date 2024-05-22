<?php

use OpenAI\Responses\VectorStores\FileBatches\VectorStoreFileBatchFileCountsResponse;

test('from', function () {
    $result = VectorStoreFileBatchFileCountsResponse::from(vectorStoreFileBatchResource()['file_counts']);

    expect($result)
        ->inProgress->toBe(12)
        ->completed->toBe(3)
        ->failed->toBe(0)
        ->cancelled->toBe(0)
        ->total->toBe(15);
});

test('as array accessible', function () {
    $result = VectorStoreFileBatchFileCountsResponse::from(vectorStoreFileBatchResource()['file_counts']);

    expect($result['total'])
        ->toBe(15);
});

test('to array', function () {
    $result = VectorStoreFileBatchFileCountsResponse::from(vectorStoreFileBatchResource()['file_counts']);

    expect($result->toArray())
        ->toBe(vectorStoreFileBatchResource()['file_counts']);
});
