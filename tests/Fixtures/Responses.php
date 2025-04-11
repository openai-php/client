<?php

/**
 * @return array<string, mixed>
 */
function createResponseResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'response',
        'created_at' => 1699619403,
        'status' => 'completed',
        'output' => [
            [
                'type' => 'message',
                'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
                'status' => 'completed',
                'role' => 'assistant',
                'content' => [
                    [
                        'type' => 'output_text',
                        'text' => 'The image depicts a scenic landscape with a wooden boardwalk or pathway leading through lush, green grass under a blue sky with some clouds. The setting suggests a peaceful natural area, possibly a park or nature reserve. There are trees and shrubs in the background.',
                        'annotations' => []
                    ]
                ]
            ]
        ],
        'parallel_tool_calls' => true,
        'previous_response_id' => null,
        'reasoning' => [
            'effort' => null,
            'generate_summary' => null
        ],
        'store' => true,
        'temperature' => 1.0,
        'text' => [
            'format' => [
                'type' => 'text'
            ]
        ],
        'tool_choice' => 'auto',
        'tools' => [],
        'top_p' => 1.0,
        'truncation' => 'disabled',
        'usage' => [
            'input_tokens' => 328,
            'input_tokens_details' => [
                'cached_tokens' => 0
            ],
            'output_tokens' => 52,
            'output_tokens_details' => [
                'reasoning_tokens' => 0
            ],
            'total_tokens' => 380
        ],
        'user' => null,
        'metadata' => []
    ];
}

/**
 * @return array<string, mixed>
 */
function retrieveResponseResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'response',
        'created_at' => 1699619403,
        'status' => 'completed'
    ];
}

/**
 * @return array<string, mixed>
 */
function listInputItemsResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
                'object' => 'response',
                'created_at' => 1699619403,
                'status' => 'completed'
            ]
        ],
        'first_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'last_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
        'has_more' => false
    ];
}

/**
 * @return array<string, mixed>
 */
function deleteResponseResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'response.deleted',
        'deleted' => true
    ];
}

/**
 * @return array<string, mixed>
 */
function createStreamedResponseResource(): array
{
    return [
        'event' => 'response.created',
        'data' => createResponse()
    ];
}

/**
 * @return resource
 */
function createStreamedResource()
{
    return fopen(__DIR__.'/Streams/CreateStreamedResponse.txt', 'r');
}
