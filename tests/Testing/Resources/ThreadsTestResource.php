<?php

use OpenAI\Resources\Threads;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadResponse;
use OpenAI\Testing\ClientFake;

it('records a thread create request', function () {
    $fake = new ClientFake([
        ThreadResponse::fake(),
    ]);

    $fake->threads()->create([]);

    $fake->assertSent(Threads::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters === [];
    });
});

it('records a thread create and run request', function () {
    $fake = new ClientFake([
        ThreadRunResponse::fake(),
    ]);

    $fake->threads()->createAndRun(
        [
            'assistant_id' => 'asst_gxzBkD1wkKEloYqZ410pT5pd',
            'thread' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Explain deep learning to a 5 year old.',
                    ],
                ],
            ],
        ],
    );

    $fake->assertSent(Threads::class, function ($method, $parameters) {
        return $method === 'createAndRun' &&
            $parameters['assistant_id'] === 'asst_gxzBkD1wkKEloYqZ410pT5pd' &&
            $parameters['thread'] === [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Explain deep learning to a 5 year old.',
                    ],
                ],
            ];
    });
});

it('records a thread retrieve request', function () {
    $fake = new ClientFake([
        ThreadResponse::fake(),
    ]);

    $fake->threads()->retrieve('thread_tKFLqzRN9n7MnyKKvc1Q7868');

    $fake->assertSent(Threads::class, function ($method, $threadId) {
        return $method === 'retrieve' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868';
    });
});

it('records a thread modify request', function () {
    $fake = new ClientFake([
        ThreadResponse::fake(),
    ]);

    $fake->threads()->modify('thread_tKFLqzRN9n7MnyKKvc1Q7868', [
        'metadata' => [
            'name' => 'My new thread name',
        ],
    ]);

    $fake->assertSent(Threads::class, function ($method, $threadId, $parameters) {
        return $method === 'modify' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $parameters['metadata'] === [
                'name' => 'My new thread name',
            ];
    });
});

it('records a thread delete request', function () {
    $fake = new ClientFake([
        ThreadDeleteResponse::fake(),
    ]);

    $fake->threads()->delete('thread_tKFLqzRN9n7MnyKKvc1Q7868');

    $fake->assertSent(Threads::class, function ($method, $threadId) {
        return $method === 'delete' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868';
    });
});
