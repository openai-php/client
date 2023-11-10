<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\ThreadDeleteResponse;

test('from', function () {
    $result = ThreadDeleteResponse::from(threadDeleteResource(), meta());

    expect($result)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ThreadDeleteResponse::from(threadDeleteResource(), meta());

    expect($result['id'])
        ->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y');
});

test('to array', function () {
    $result = ThreadDeleteResponse::from(threadDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(threadDeleteResource());
});

test('fake', function () {
    $response = ThreadDeleteResponse::fake();

    expect($response)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = ThreadDeleteResponse::fake([
        'id' => 'thread_1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('thread_1234')
        ->deleted->toBe(false);
});
