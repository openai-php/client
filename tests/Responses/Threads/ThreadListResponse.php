<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\ThreadListResponse;
use OpenAI\Responses\Threads\ThreadResponse;

test('from', function () {
    $response = ThreadListResponse::from(threadListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ThreadListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ThreadListResponse::from(threadListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ThreadListResponse::from(threadListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(threadListResource());
});

test('fake', function () {
    $response = ThreadListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y');
});

test('fake with override', function () {
    $response = ThreadListResponse::fake([
        'data' => [
            [
                'id' => 'thread_1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('thread_1234');
});
