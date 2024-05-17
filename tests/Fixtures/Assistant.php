<?php

/**
 * @return array<string, mixed>
 */
function assistantResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant',
        'created_at' => 1699619403,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'tool_resources' => [],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => 'text',
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithJsonObjectResponseFormat(): array
{
    return [
        'id' => 'asst_reHHtAM0jKLDIxanM6gP6DaR',
        'object' => 'assistant',
        'created_at' => 1699642651,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'add',
                    'description' => 'Returns the sum of two numbers',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'a' => [
                                'type' => 'number',
                            ],
                            'b' => [
                                'type' => 'number',
                            ],
                        ],
                        'required' => [
                            'a',
                            'b',
                        ],
                    ],
                ],
            ],
        ],
        'tool_resources' => [],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => ['type' => 'json_object'],
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithTextResponseFormat(): array
{
    return [
        'id' => 'asst_reHHtAM0jKLDIxanM6gP6DaR',
        'object' => 'assistant',
        'created_at' => 1699642651,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'add',
                    'description' => 'Returns the sum of two numbers',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'a' => [
                                'type' => 'number',
                            ],
                            'b' => [
                                'type' => 'number',
                            ],
                        ],
                        'required' => [
                            'a',
                            'b',
                        ],
                    ],
                ],
            ],
        ],
        'tool_resources' => [],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => ['type' => 'text'],
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithFunctionToolResource(): array
{
    return [
        'id' => 'asst_reHHtAM0jKLDIxanM6gP6DaR',
        'object' => 'assistant',
        'created_at' => 1699642651,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'add',
                    'description' => 'Returns the sum of two numbers',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'a' => [
                                'type' => 'number',
                            ],
                            'b' => [
                                'type' => 'number',
                            ],
                        ],
                        'required' => [
                            'a',
                            'b',
                        ],
                    ],
                ],
            ],
        ],
        'tool_resources' => [],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => 'text',
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithAllToolsResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant',
        'created_at' => 1699619403,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
            [
                'type' => 'file_search',
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'add',
                    'description' => 'Returns the sum of two numbers',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'a' => [
                                'type' => 'number',
                            ],
                            'b' => [
                                'type' => 'number',
                            ],
                        ],
                        'required' => [
                            'a',
                            'b',
                        ],
                    ],
                ],
            ],
        ],
        'tool_resources' => [],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => 'text',
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithFileSearchResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant',
        'created_at' => 1699619403,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor.',
        'tools' => [
            [
                'type' => 'file_search',
            ],
        ],
        'tool_resources' => [
            [
                'type' => 'file_search',
                'vector_store_ids' => ['file-test0001'],
            ],
        ],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => 'text',
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithCodeInterpreterResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant',
        'created_at' => 1699619403,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'tool_resources' => [
            [
                'type' => 'code_interpreter',
                'file_ids' => ['file-test0001'],
            ],
        ],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => 'text',
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            assistantResource(),
            assistantResource(),
        ],
        'first_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'last_id' => 'asst_y49lAdZDiaQUxEBR6zrG846Q',
        'has_more' => true,
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantDeleteResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant.deleted',
        'deleted' => true,
    ];
}
