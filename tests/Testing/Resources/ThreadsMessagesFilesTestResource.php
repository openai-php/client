<?php

use OpenAI\Resources\ThreadsMessagesFiles;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileListResponse;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;
use OpenAI\Testing\ClientFake;

it('records a thread message file retrieve request', function () {
    $fake = new ClientFake([
        ThreadMessageFileResponse::fake(),
    ]);

    $fake->threads()->messages()->files()->retrieve(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        messageId: 'msg_SKYwvF3zcigxthfn6F4hnpdU',
        fileId: 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
    );

    $fake->assertSent(ThreadsMessagesFiles::class, function ($method, $threadId, $messageId, $fileId) {
        return $method === 'retrieve' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $messageId === 'msg_SKYwvF3zcigxthfn6F4hnpdU' &&
            $fileId === 'file-DhxjnFCaSHc4ZELRGKwTMFtI';
    });
});

it('records a thread message file list request', function () {
    $fake = new ClientFake([
        ThreadMessageFileListResponse::fake(),
    ]);

    $fake->threads()->messages()->files()->list(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        messageId: 'msg_SKYwvF3zcigxthfn6F4hnpdU',
        parameters: [
            'limit' => 10,
        ],
    );

    $fake->assertSent(ThreadsMessagesFiles::class, function ($method, $threadId, $messageId, $parameters) {
        return $method === 'list' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $messageId === 'msg_SKYwvF3zcigxthfn6F4hnpdU' &&
            $parameters['limit'] === 10;
    });
});
