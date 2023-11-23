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
        'file_ids' => [],
        'metadata' => [],
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
        'file_ids' => [],
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantWithRetrievalToolResource(): array
{
    return [
        'id' => 'asst_3jHvDyRbElRz2yig9RrPT9cX',
        'object' => 'assistant',
        'created_at' => 1699642972,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4-1106-preview',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'retrieval',
            ],
        ],
        'file_ids' => [],
        'metadata' => [],
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
                'type' => 'retrieval',
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
        'file_ids' => [],
        'metadata' => [],
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
