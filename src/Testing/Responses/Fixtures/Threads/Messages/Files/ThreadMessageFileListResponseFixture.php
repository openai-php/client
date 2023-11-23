<?php

namespace OpenAI\Testing\Responses\Fixtures\Threads\Messages\Files;

final class ThreadMessageFileListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
                'object' => 'thread.message.file',
                'created_at' => 1_699_624_660,
                'message_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
            ],
        ],
        'first_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
        'last_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
        'has_more' => false,
    ];
}
