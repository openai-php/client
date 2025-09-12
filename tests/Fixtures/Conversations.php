<?php

function conversationResource(): array
{
    return [
        'id' => 'conv_123',
        'object' => 'conversation',
        'created_at' => 1741900000,
        'metadata' => ['topic' => 'demo'],
    ];
}

function conversationDeletedResource(): array
{
    return [
        'id' => 'conv_123',
        'object' => 'conversation.deleted',
        'deleted' => true,
    ];
}

function conversationItemResource(): array
{
    return [
        'content' => [
            [
                'text' => 'Hello!',
                'type' => 'input_text',
            ],
        ],
        'id' => 'msg_abc',
        'role' => 'user',
        'status' => 'completed',
        'type' => 'message',
    ];
}

function conversationItemListResource(): array
{
    return [
        'object' => 'list',
        'data' => [conversationItemResource()],
        'first_id' => 'msg_abc',
        'last_id' => 'msg_abc',
        'has_more' => false,
    ];
}
