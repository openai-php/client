<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses;

final class ListInputItemsFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'content' => [
                    [
                        'text' => 'What was a positive news story from today?',
                        'type' => 'input_text',
                        'annotations' => [],
                    ],
                ],
                'id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
                'role' => 'user',
                'status' => 'completed',
                'type' => 'message',
            ],
        ],
        'first_id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'last_id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'has_more' => false,
    ];
}
