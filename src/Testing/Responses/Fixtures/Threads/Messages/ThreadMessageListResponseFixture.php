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
                'incomplete_details' => null,
                'temperature' => 1,
                'top_p' => 1,
                'max_prompt_tokens' => 600,
                'max_completion_tokens' => 500,
                'truncation_strategy' => [
                    'type' => 'auto',
                    'last_messages' => null,
                ],
                'tool_choice' => 'none',
                'response_format' => 'auto',
            ],
        ],
        'first_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'last_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'has_more' => false,
    ];
}
