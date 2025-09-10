<?php

namespace OpenAI\Testing\Responses\Fixtures\Conversations;

final class ConversationItemFixture
{
    public const ATTRIBUTES = [
        'type' => 'message',
        'id' => 'msg_abc',
        'status' => 'completed',
        'role' => 'user',
        'content' => [
            ['type' => 'input_text', 'text' => 'Hello!'],
        ],
    ];
}
