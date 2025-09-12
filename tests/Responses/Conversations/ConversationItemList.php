<?php

use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\ConversationItemList;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ConversationItemList::from(conversationItemListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ConversationItemList::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->{0}->toBeInstanceOf(ConversationItem::class)
        ->firstId->toBe('msg_abc')
        ->lastId->toBe('msg_abc')
        ->hasMore->toBeFalse();

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ConversationItemList::from(conversationItemListResource(), meta());

    expect($response['object'])
        ->toBe('list');
});

test('to array', function () {
    $response = ConversationItemList::from(conversationItemListResource(), meta());

    expect($response->toArray())
        ->toBe(conversationItemListResource());
});
