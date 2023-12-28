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
                        [
                            'type' => 'file_path',
                            'text' => 'sandbox:/mnt/data/shuffled_file.csv',
                            'start_index' => 167,
                            'end_index' => 202,
                            'file_path' => [
                                'file_id' => 'file-oSgJAzAnnQkVB3u7yCoE9CBe',
                            ],
                        ],
                        [
                            'type' => 'file_citation',
                            'text' => 'The content to replace.',
                            'start_index' => 23,
                            'end_index' => 25,
                            'file_citation' => [
                                'file_id' => 'file-oSgJAzAnnQkVB3u7yCoE9CBe',
                                'quote' => 'To be or not to be, that is the question.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'image_file',
                'image_file' => [
                    'file_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
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
