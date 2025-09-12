<?php

use OpenAI\Responses\Conversations\ConversationDeletedResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ConversationDeletedResponse::from(conversationDeletedResource(), meta());

    expect($response)
        ->toBeInstanceOf(ConversationDeletedResponse::class)
        ->id->toBe('conv_123')
        ->object->toBe('conversation.deleted')
        ->deleted->toBeTrue();

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ConversationDeletedResponse::from(conversationDeletedResource(), meta());

    expect($response['object'])
        ->toBe('conversation.deleted');
});

test('to array', function () {
    $response = ConversationDeletedResponse::from(conversationDeletedResource(), meta());

    expect($response->toArray())
        ->toBe(conversationDeletedResource());
});
