<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolCodeInterpreter;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadResponse;
use OpenAI\ValueObjects\Transporter\Response;

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
    $client = mockClient('POST', 'threads/runs', [
        'assistant_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'thread' => [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Explain deep learning to a 5 year old.',
                ],
            ],
        ],
    ], Response::from(threadRunResource(), metaHeaders()));

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
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toHaveCount(1)
        ->metadata->toBeArray()->toBeEmpty();

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
