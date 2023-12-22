<?php

use OpenAI\Resources\ThreadsMessages;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Testing\ClientFake;

it('records a thread message create request', function () {
    $fake = new ClientFake([
        ThreadMessageResponse::fake(),
    ]);

    $fake->threads()->messages()->create('thread_tKFLqzRN9n7MnyKKvc1Q7868', [
        'role' => 'user',
        'content' => 'What is the sum of 5 and 7?',
    ]);

    $fake->assertSent(ThreadsMessages::class, function ($method, $threadId, $parameters) {
        return $method === 'create' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $parameters['role'] === 'user' &&
            $parameters['content'] === 'What is the sum of 5 and 7?';
    });
});

it('records a thread message retrieve request', function () {
    $fake = new ClientFake([
        ThreadMessageResponse::fake(),
    ]);

    $fake->threads()->messages()->retrieve(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        messageId: 'msg_SKYwvF3zcigxthfn6F4hnpdU',
    );

    $fake->assertSent(ThreadsMessages::class, function ($method, $threadId, $messageId) {
        return $method === 'retrieve' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $messageId === 'msg_SKYwvF3zcigxthfn6F4hnpdU';
    });
});

it('records a thread message modify request', function () {
    $fake = new ClientFake([
        ThreadMessageResponse::fake(),
    ]);

    $fake->threads()->messages()->modify(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        messageId: 'msg_SKYwvF3zcigxthfn6F4hnpdU',
        parameters: [
            'metadata' => [
                'name' => 'My new message name',
            ],
        ],
    );

    $fake->assertSent(ThreadsMessages::class, function ($method, $threadId, $messageId, $parameters) {
        return $method === 'modify' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $messageId === 'msg_SKYwvF3zcigxthfn6F4hnpdU' &&
            $parameters['metadata'] === [
                'name' => 'My new message name',
            ];
    });
});

it('records a thread message list request', function () {
    $fake = new ClientFake([
        ThreadMessageListResponse::fake(),
    ]);

    $fake->threads()->messages()->list('thread_tKFLqzRN9n7MnyKKvc1Q7868', [
        'limit' => 10,
    ]);

    $fake->assertSent(ThreadsMessages::class, function ($method, $threadId, $parameters) {
        return $method === 'list' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $parameters['limit'] === 10;
    });
});
