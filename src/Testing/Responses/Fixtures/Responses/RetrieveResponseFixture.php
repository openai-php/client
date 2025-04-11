<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses;

final class RetrieveResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'resp_67cb71b351908190a308f3859487620d06981a8637e6bc44',
        'object' => 'response',
        'created_at' => 1741386163,
        'status' => 'completed',
        'error' => null,
        'incomplete_details' => null,
        'instructions' => null,
        'max_output_tokens' => null,
        'model' => 'gpt-4o-2024-08-06',
        'output' => [
            [
                'type' => 'message',
                'id' => 'msg_67cb71b3c2b0819084d481baaaf148f206981a8637e6bc44',
                'status' => 'completed',
                'role' => 'assistant',
                'content' => [
                    [
                        'type' => 'output_text',
                        'text' => 'Silent circuits hum,  \nThoughts emerge in data streams—  \nDigital dawn breaks.',
                        'annotations' => [],
                    ],
                ],
            ],
        ],
        'parallel_tool_calls' => true,
        'previous_response_id' => null,
        'reasoning' => [
            'effort' => null,
            'summary' => null,
        ],
        'store' => true,
        'temperature' => 1.0,
        'text' => [
            'format' => [
                'type' => 'text',
            ],
        ],
        'tool_choice' => 'auto',
        'tools' => [],
        'top_p' => 1.0,
        'truncation' => 'disabled',
        'usage' => [
            'input_tokens' => 32,
            'input_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'output_tokens' => 18,
            'output_tokens_details' => [
                'reasoning_tokens' => 0,
            ],
            'total_tokens' => 50,
        ],
        'user' => null,
        'metadata' => [],
    ];
}
