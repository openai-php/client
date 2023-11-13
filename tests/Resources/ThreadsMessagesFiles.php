<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileListResponse;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages/msg_KNsDDwE41BUAHhcPNpDkdHWZ/files', [], Response::from(threadMessageFileListResource(), metaHeaders()));

    $result = $client->threads()->messages()->files()->list('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'msg_KNsDDwE41BUAHhcPNpDkdHWZ');

    expect($result)
        ->toBeInstanceOf(ThreadMessageFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadMessageFileResponse::class)
        ->firstId->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI')
        ->lastId->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages/msg_KNsDDwE41BUAHhcPNpDkdHWZ/files/file-DhxjnFCaSHc4ZELRGKwTMFtI', [], Response::from(threadMessageFileResource(), metaHeaders()));

    $result = $client->threads()->messages()->files()->retrieve('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'msg_KNsDDwE41BUAHhcPNpDkdHWZ', 'file-DhxjnFCaSHc4ZELRGKwTMFtI');

    expect($result)
        ->toBeInstanceOf(ThreadMessageFileResponse::class)
        ->id->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI')
        ->object->toBe('thread.message.file')
        ->createdAt->toBe(1699624660)
        ->messageId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
