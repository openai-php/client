<?php

use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\Objects\Message;

test('from', function () {
    $response = ConversationItem::from(conversationItemResource());

    expect($response)
        ->toBeInstanceOf(ConversationItem::class)
        ->item->toBeInstanceOf(Message::class)
        ->item->id->toBe('msg_abc');
});

test('as array accessible', function () {
    $response = ConversationItem::from(conversationItemResource());

    expect($response['id'])
        ->toBe('msg_abc');
});

test('to array', function () {
    $response = ConversationItem::from(conversationItemResource());

    expect($response->toArray())
        ->toBe(conversationItemResource());
});
