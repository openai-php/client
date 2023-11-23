<?php

/**
 * @return array<string, mixed>
 */
function threadRunResource(): array
{
    return [
        'id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'object' => 'thread.run',
        'created_at' => 1699621735,
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_EKt7MjGOC6bwKWmenQv5VD6r',
        'status' => 'queued',
        'started_at' => null,
        'expires_at' => 1699622335,
        'cancelled_at' => null,
        'failed_at' => null,
        'completed_at' => null,
        'last_error' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'file_ids' => [
            'file-6EsV79Y261TEmi0PY5iHbZdS',
        ],
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunWithRetrievalToolResource(): array
{
    return [
        'id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'object' => 'thread.run',
        'created_at' => 1699621735,
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_EKt7MjGOC6bwKWmenQv5VD6r',
        'status' => 'queued',
        'started_at' => null,
        'expires_at' => 1699622335,
        'cancelled_at' => null,
        'failed_at' => null,
        'completed_at' => null,
        'last_error' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'retrieval',
            ],
        ],
        'file_ids' => [
            'file-6EsV79Y261TEmi0PY5iHbZdS',
        ],
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunWithLasErrorResource(): array
{
    return [
        'id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'object' => 'thread.run',
        'created_at' => 1699621735,
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_EKt7MjGOC6bwKWmenQv5VD6r',
        'status' => 'failed',
        'started_at' => null,
        'expires_at' => 1699622335,
        'cancelled_at' => null,
        'failed_at' => null,
        'completed_at' => null,
        'last_error' => [
            'code' => 'rate_limit_exceeded',
            'message' => 'You have exceeded your API request quota. Please try again later.',
        ],
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'file_ids' => [
            'file-6EsV79Y261TEmi0PY5iHbZdS',
        ],
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunWithSubmitToolOutputsResource(): array
{
    return [
        'id' => 'run_vqUh7mLCAIYjudfN34dMQx4b',
        'object' => 'thread.run',
        'created_at' => 1699626348,
        'assistant_id' => 'asst_elNhDubXFZcsWQd8GuTu93vZ',
        'thread_id' => 'thread_vAG0173KCY4VKDLQakucIszZ',
        'status' => 'requires_action',
        'started_at' => 1699626349,
        'expires_at' => 1699626948,
        'cancelled_at' => null,
        'failed_at' => null,
        'completed_at' => null,
        'required_action' => [
            'type' => 'submit_tool_outputs',
            'submit_tool_outputs' => [
                'tool_calls' => [
                    [
                        'id' => 'call_KSg14X7kZF2WDzlPhpQ168Mj',
                        'type' => 'function',
                        'function' => [
                            'name' => 'add',
                            'arguments' => '{ "a": 5, "b": 7 }',
                        ],
                    ],
                ],
            ],
        ],
        'last_error' => null,
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
function threadRunListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            threadRunResource(),
            threadRunResource(),
        ],
        'first_id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'last_id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'has_more' => false,
    ];
}
