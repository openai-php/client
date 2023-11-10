<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\ThreadResponse;

test('from', function () {
    $result = ThreadResponse::from(threadResource(), meta());

    expect($result)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread')
        ->createdAt->toBe(1699621778)
        ->metadata->toBe([])
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ThreadResponse::from(threadResource(), meta());

    expect($result['id'])
        ->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y');
});

test('to array', function () {
    $result = ThreadResponse::from(threadResource(), meta());

    expect($result->toArray())
        ->toBe(threadResource());
});

test('fake', function () {
    $response = ThreadResponse::fake();

    expect($response)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y');
});

test('fake with override', function () {
    $response = ThreadResponse::fake([
        'id' => 'thread_1234',
    ]);

    expect($response)
        ->id->toBe('thread_1234');
});
