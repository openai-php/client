<?php

use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponseLastError;

test('from', function () {
    $result = VectorStoreFileResponseLastError::from(vectorStoreFileWithLastErrorResource()['last_error'], meta());

    expect($result)
        ->code->toBe('error-001')
        ->message->toBe('Error scanning file');
});

test('as array accessible', function () {
    $result = VectorStoreFileResponseLastError::from(vectorStoreFileWithLastErrorResource()['last_error'], meta());

    expect($result['message'])
        ->toBe('Error scanning file');
});

test('to array', function () {
    $result = VectorStoreFileResponseLastError::from(vectorStoreFileWithLastErrorResource()['last_error'], meta());

    expect($result->toArray())
        ->toBe(vectorStoreFileWithLastErrorResource()['last_error']);
});
