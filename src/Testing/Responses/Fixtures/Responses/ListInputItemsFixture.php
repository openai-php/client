<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses;

final class ListInputItemsFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'type' => 'message',
                'id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
                'status' => 'completed',
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'What was a positive news story from today?',
                        'annotations' => [],
                    ],
                ],
            ],
        ],
        'first_id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'last_id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'has_more' => false,
    ];
}
