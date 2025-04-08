<?php

namespace OpenAI\Testing\Responses\Fixtures\Threads\Messages;

final class ThreadMessageListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
                'object' => 'thread.message',
                'created_at' => 1_699_623_839,
                'thread_id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
                'status' => 'in_progress',
                'incomplete_details' => null,
                'completed_at' => null,
                'incomplete_at' => null,
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => [
                            'value' => 'How does AI work? Explain it in simple terms.',
                            'annotations' => [
                            ],
                        ],
                    ],
                ],
                'attachments' => [
                    [
                        'file_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
                        'tools' => [['type' => 'file_search']],
                    ],
                ],
                'assistant_id' => null,
                'run_id' => null,
                'metadata' => [],
            ],
        ],
        'first_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'last_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'has_more' => false,
    ];
}
