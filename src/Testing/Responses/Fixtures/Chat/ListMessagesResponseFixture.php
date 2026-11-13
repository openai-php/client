<?php

namespace OpenAI\Testing\Responses\Fixtures\Chat;

final class ListMessagesResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'chatcmpl-123-0',
                'role' => 'user',
                'content' => 'Hello!',
                'name' => null,
                'content_parts' => null,
            ],
        ],
        'first_id' => 'chatcmpl-123-0',
        'last_id' => 'chatcmpl-123-0',
        'has_more' => false,
    ];
}
