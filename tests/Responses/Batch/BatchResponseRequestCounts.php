<?php

use OpenAI\Responses\Batches\BatchResponseRequestCounts;

test('from', function () {
    $response = BatchResponseRequestCounts::from(batchResource()['request_counts']);

    expect($response)
        ->toBeInstanceOf(BatchResponseRequestCounts::class)
        ->total->toBe(100)
        ->completed->toBe(95)
        ->failed->toBe(5);
});

test('as array accessible', function () {
    $response = BatchResponseRequestCounts::from(batchResource()['request_counts']);

    expect($response['total'])->toBe(100);
});

test('to array', function () {
    $response = BatchResponseRequestCounts::from(batchResource()['request_counts']);

    expect($response->toArray())
        ->toBeArray()
        ->toBe(batchResource()['request_counts']);
});
