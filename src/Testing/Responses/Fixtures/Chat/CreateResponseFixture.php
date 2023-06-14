<?php

namespace OpenAI\Testing\Responses\Fixtures\Chat;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1_677_652_288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, this is a fake chat response.",
                    'function_call' => null,
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
