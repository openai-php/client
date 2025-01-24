<?php

use OpenAI\Responses\VectorStores\VectorStoreResponseExpiresAfter;

test('from', function () {
    $result = VectorStoreResponseExpiresAfter::from(vectorStoreWithExpiresAfterResource()['expires_after']);

    expect($result)
        ->anchor->toBe('last_active_at')
        ->days->toBe(7);
});

test('as array accessible', function () {
    $result = VectorStoreResponseExpiresAfter::from(vectorStoreWithExpiresAfterResource()['expires_after']);

    expect($result['anchor'])
        ->toBe('last_active_at');
});

test('to array', function () {
    $result = VectorStoreResponseExpiresAfter::from(vectorStoreWithExpiresAfterResource()['expires_after']);

    expect($result->toArray())
        ->toBe(vectorStoreWithExpiresAfterResource()['expires_after']);
});
