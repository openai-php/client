<?php

/**
 * @return array<string, mixed>
 */
function chatCompletion(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, how may I assist you today?",
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
        ],
    ];
}
