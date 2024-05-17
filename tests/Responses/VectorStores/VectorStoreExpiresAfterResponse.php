<?php

use OpenAI\Responses\VectorStores\VectorStoreExpiresAfterResponse;

test('from', function () {
    $result = VectorStoreExpiresAfterResponse::from(vectorStoreWithExpiresAfterResource()['expires_after']);

    expect($result)
        ->anchor->toBe('last_active_at')
        ->days->toBe(7);
});

test('as array accessible', function () {
    $result = VectorStoreExpiresAfterResponse::from(vectorStoreWithExpiresAfterResource()['expires_after']);

    expect($result['anchor'])
        ->toBe('last_active_at');
});

test('to array', function () {
    $result = VectorStoreExpiresAfterResponse::from(vectorStoreWithExpiresAfterResource()['expires_after']);

    expect($result->toArray())
        ->toBe(vectorStoreWithExpiresAfterResource()['expires_after']);
});
