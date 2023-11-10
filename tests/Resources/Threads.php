<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadListResponse;
use OpenAI\Responses\Threads\ThreadResponse;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'threads', [], Response::from(threadListResource(), metaHeaders()));

    $result = $client->threads()->list();

    expect($result)
        ->toBeInstanceOf(ThreadListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadResponse::class)
        ->firstId->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->lastId->toBe('thread_qVpWfffa654XBdU3tl2iUdVy')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'threads', [], Response::from(threadResource(), metaHeaders()));

    $result = $client->threads()->create([]);

    expect($result)
        ->toBeInstanceOf(ThreadResponse::class)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread')
        ->createdAt->toBe(1699621778)
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create and run', function () {
    $client = mockClient('POST', 'threads', [
        'assistant_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'thread' => [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Explain deep learning to a 5 year old.',
                ],
            ],
        ],
    ], Response::from(threadResource(), metaHeaders()));

    $result = $client->threads()->createAndRun([
        'assistant_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'thread' => [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Explain deep learning to a 5 year old.',
                ],
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadResponse::class)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread')
        ->createdAt->toBe(1699621778)
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('modify', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y', [
        'metadata' => [
            'name' => 'My new thread name',
        ],
    ], Response::from(threadResource(), metaHeaders()));

    $result = $client->threads()->modify('thread_agvtHUGezjTCt4SKgQg0NJ2Y', [
        'metadata' => [
            'name' => 'My new thread name',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadResponse::class)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread')
        ->createdAt->toBe(1699621778)
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y', [], Response::from(threadResource(), metaHeaders()));

    $result = $client->threads()->retrieve('thread_agvtHUGezjTCt4SKgQg0NJ2Y');

    expect($result)
        ->toBeInstanceOf(ThreadResponse::class)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread')
        ->object->toBe('thread')
        ->createdAt->toBe(1699621778)
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y', [], Response::from(threadDeleteResource(), metaHeaders()));

    $result = $client->threads()->delete('thread_agvtHUGezjTCt4SKgQg0NJ2Y');

    expect($result)
        ->toBeInstanceOf(ThreadDeleteResponse::class)
        ->id->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->object->toBe('thread.deleted')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
