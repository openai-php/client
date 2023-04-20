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

function chatCompletionStreamFirstChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'role' => 'assistant',
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

function chatCompletionStreamContentChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'content' => 'Hello',
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

/**
 * @return resource
 */
function chatCompletionStream()
{
    return fopen(__DIR__.'/Streams/ChatCompletionCreate.txt', 'r');
}
