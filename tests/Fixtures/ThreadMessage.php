<?php

/**
 * @return array<string, mixed>
 */
function threadMessageResource(): array
{
    return [
        'id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'object' => 'thread.message',
        'created_at' => 1699623839,
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
        'file_ids' => [
            'file-DhxjnFCaSHc4ZELRGKwTMFtI',
        ],
        'assistant_id' => null,
        'run_id' => null,
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadMessageListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            threadMessageResource(),
            threadMessageResource(),
        ],
        'first_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'last_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function threadMessageDeleteResource(): array
{
    return [
        'id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'object' => 'thread.message.deleted',
        'deleted' => true,
    ];
}
