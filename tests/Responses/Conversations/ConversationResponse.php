<?php

use OpenAI\Responses\Conversations\ConversationResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ConversationResponse::from(conversationResource(), meta());

    expect($response)
        ->toBeInstanceOf(ConversationResponse::class)
        ->id->toBe('conv_123')
        ->object->toBe('conversation')
        ->createdAt->toBe(1741900000)
        ->metadata->toBe(['topic' => 'demo']);

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ConversationResponse::from(conversationResource(), meta());

    expect($response['id'])
        ->toBe('conv_123');
});

test('to array', function () {
    $response = ConversationResponse::from(conversationResource(), meta());

    expect($response->toArray())
        ->toBe(conversationResource());
});
