<?php

namespace OpenAI\Testing\Responses\Fixtures\Conversations;

final class ConversationItemListFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            ConversationItemFixture::ATTRIBUTES,
            ConversationItemFixture::ATTRIBUTES,
        ],
        'first_id' => 'msg_abc',
        'last_id' => 'msg_abc',
        'has_more' => false,
    ];
}
