<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Messages\ThreadMessageDeleteResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseAttachment;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentImageFileObject;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextObject;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages', [], Response::from(threadMessageListResource(), metaHeaders()));

    $result = $client->threads()->messages()->list('thread_agvtHUGezjTCt4SKgQg0NJ2Y');

    expect($result)
        ->toBeInstanceOf(ThreadMessageListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadMessageResponse::class)
        ->firstId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->lastId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages', [
        'role' => 'user',
        'content' => 'How does AI work? Explain it in simple terms.',
        'attachments' => [
            [
                'file_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
                'tools' => [['type' => 'file_search']],
            ],
        ],
    ], Response::from(threadMessageResource(), metaHeaders()));

    $result = $client->threads()->messages()->create('thread_agvtHUGezjTCt4SKgQg0NJ2Y', [
        'role' => 'user',
        'content' => 'How does AI work? Explain it in simple terms.',
        'attachments' => [
            [
                'file_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
                'tools' => [['type' => 'file_search']],
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadMessageResponse::class)
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->object->toBe('thread.message')
        ->createdAt->toBe(1699623839)
        ->threadId->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->role->toBe('user')
        ->content->toBeArray()
        ->content->toHaveCount(3)
        ->content->{0}->toBeInstanceOf(ThreadMessageResponseContentTextObject::class)
        ->content->{1}->toBeInstanceOf(ThreadMessageResponseContentImageFileObject::class)
        ->attachments->toBeArray()
        ->attachments->{0}->toBeInstanceOf(ThreadMessageResponseAttachment::class)
        ->assistantId->toBeNull()
        ->runId->toBeNull()
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('modify', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages/msg_KNsDDwE41BUAHhcPNpDkdHWZ', [
        'metadata' => [
            'name' => 'My new message name',
        ],
    ], Response::from(threadMessageResource(), metaHeaders()));

    $result = $client->threads()->messages()->modify('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'msg_KNsDDwE41BUAHhcPNpDkdHWZ', [
        'metadata' => [
            'name' => 'My new message name',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadMessageResponse::class)
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->object->toBe('thread.message')
        ->createdAt->toBe(1699623839)
        ->threadId->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->role->toBe('user')
        ->content->toBeArray()
        ->content->toHaveCount(3)
        ->content->{0}->toBeInstanceOf(ThreadMessageResponseContentTextObject::class)
        ->content->{1}->toBeInstanceOf(ThreadMessageResponseContentImageFileObject::class)
        ->attachments->toBeArray()
        ->attachments->{0}->toBeInstanceOf(ThreadMessageResponseAttachment::class)
        ->assistantId->toBeNull()
        ->runId->toBeNull()
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages/msg_KNsDDwE41BUAHhcPNpDkdHWZ', [], Response::from(threadMessageResource(), metaHeaders()));

    $result = $client->threads()->messages()->retrieve('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'msg_KNsDDwE41BUAHhcPNpDkdHWZ');

    expect($result)
        ->toBeInstanceOf(ThreadMessageResponse::class)
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->object->toBe('thread.message')
        ->createdAt->toBe(1699623839)
        ->threadId->toBe('thread_agvtHUGezjTCt4SKgQg0NJ2Y')
        ->role->toBe('user')
        ->content->toBeArray()
        ->content->toHaveCount(3)
        ->content->{0}->toBeInstanceOf(ThreadMessageResponseContentTextObject::class)
        ->content->{1}->toBeInstanceOf(ThreadMessageResponseContentImageFileObject::class)
        ->attachments->toBeArray()
        ->attachments->{0}->toBeInstanceOf(ThreadMessageResponseAttachment::class)
        ->assistantId->toBeNull()
        ->runId->toBeNull()
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/messages/msg_KNsDDwE41BUAHhcPNpDkdHWZ', [], Response::from(threadMessageDeleteResource(), metaHeaders()));

    $result = $client->threads()->messages()->delete('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'msg_KNsDDwE41BUAHhcPNpDkdHWZ');

    expect($result)
        ->toBeInstanceOf(ThreadMessageDeleteResponse::class)
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->object->toBe('thread.message.deleted')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
