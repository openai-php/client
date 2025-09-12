<?php

use OpenAI\Responses\Conversations\ConversationDeletedResponse;
use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\ConversationItemList;
use OpenAI\Responses\Conversations\ConversationResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('responses.conversations create', function () {
    $client = mockClient('POST', 'conversations', [
        'metadata' => ['topic' => 'demo'],
        'items' => [
            [
                'type' => 'message',
                'role' => 'user',
                'content' => 'Hello!',
            ],
        ],
    ], Response::from(conversationResource(), metaHeaders()));

    $result = $client->responses()->conversations()->create([
        'metadata' => ['topic' => 'demo'],
        'items' => [
            [
                'type' => 'message',
                'role' => 'user',
                'content' => 'Hello!',
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ConversationResponse::class)
        ->id->toBe('conv_123')
        ->object->toBe('conversation')
        ->createdAt->toBe(1741900000)
        ->metadata->toBe(['topic' => 'demo']);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('responses.conversations retrieve', function () {
    $client = mockClient('GET', 'conversations/conv_123', [], Response::from(conversationResource(), metaHeaders()));

    $result = $client->responses()->conversations()->retrieve('conv_123');

    expect($result)
        ->toBeInstanceOf(ConversationResponse::class)
        ->id->toBe('conv_123');
});

test('responses.conversations update', function () {
    $client = mockClient('POST', 'conversations/conv_123', [
        'metadata' => ['foo' => 'bar'],
    ], Response::from(conversationResource(), metaHeaders()));

    $result = $client->responses()->conversations()->update('conv_123', [
        'metadata' => ['foo' => 'bar'],
    ]);

    expect($result)
        ->toBeInstanceOf(ConversationResponse::class)
        ->id->toBe('conv_123');
});

test('responses.conversations delete', function () {
    $client = mockClient('DELETE', 'conversations/conv_123', [], Response::from(conversationDeletedResource(), metaHeaders()));

    $result = $client->responses()->conversations()->delete('conv_123');

    expect($result)
        ->toBeInstanceOf(ConversationDeletedResponse::class)
        ->id->toBe('conv_123')
        ->object->toBe('conversation.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('responses.conversations.items create', function () {
    $client = mockClient('POST', 'conversations/conv_123/items', [
        'items' => [
            [
                'type' => 'message',
                'role' => 'user',
                'content' => [['type' => 'input_text', 'text' => 'Hello!']],
            ],
            [
                'type' => 'message',
                'role' => 'user',
                'content' => [['type' => 'input_text', 'text' => 'How are you?']],
            ],
        ],
    ], Response::from(conversationItemListResource(), metaHeaders()));

    $result = $client->responses()->conversations()->items()->create('conv_123', [
        'items' => [
            [
                'type' => 'message',
                'role' => 'user',
                'content' => [['type' => 'input_text', 'text' => 'Hello!']],
            ],
            [
                'type' => 'message',
                'role' => 'user',
                'content' => [['type' => 'input_text', 'text' => 'How are you?']],
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ConversationItemList::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->{0}->toBeInstanceOf(ConversationItem::class)
        ->firstId->toBe('msg_abc')
        ->lastId->toBe('msg_abc')
        ->hasMore->toBe(false);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('responses.conversations.items list', function () {
    $client = mockClient('GET', 'conversations/conv_123/items', [
        'limit' => 10,
    ], Response::from(conversationItemListResource(), metaHeaders()));

    $result = $client->responses()->conversations()->items()->list('conv_123', [
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(ConversationItemList::class)
        ->object->toBe('list');
});

test('responses.conversations.items retrieve', function () {
    $client = mockClient('GET', 'conversations/conv_123/items/msg_abc', [
        'include' => ['step_details'],
    ], Response::from(conversationItemResource(), metaHeaders()));

    $result = $client->responses()->conversations()->items()->retrieve('conv_123', 'msg_abc', [
        'include' => ['step_details'],
    ]);

    expect($result)
        ->toBeInstanceOf(ConversationItem::class)
        ->item->id->toBe('msg_abc');
});

test('responses.conversations.items delete', function () {
    $client = mockClient('DELETE', 'conversations/conv_123/items/msg_abc', [], Response::from(conversationResource(), metaHeaders()));

    $result = $client->responses()->conversations()->items()->delete('conv_123', 'msg_abc');

    expect($result)
        ->toBeInstanceOf(ConversationResponse::class)
        ->id->toBe('conv_123');
});
