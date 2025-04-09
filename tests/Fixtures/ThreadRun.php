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
        'incomplete_details' => null,
        'last_error' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'metadata' => [],
        'temperature' => 1.0,
        'top_p' => 1.0,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => 'none',
        'response_format' => 'auto',
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
                'type' => 'file_search',
            ],
        ],
        'metadata' => [],
        'incomplete_details' => null,
        'temperature' => 1,
        'top_p' => 1,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => 'none',
        'response_format' => 'auto',
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunWithToolChoiceFunction(): array
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
                'type' => 'file_search',
            ],
        ],
        'metadata' => [],
        'incomplete_details' => null,
        'temperature' => 1,
        'top_p' => 1,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => [
            'type' => 'function',
            'function' => [
                'name' => 'calculate_sum',
            ],
        ],
        'response_format' => 'auto',
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
        'metadata' => [],
        'incomplete_details' => null,
        'temperature' => 1,
        'top_p' => 1,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => 'none',
        'response_format' => 'auto',
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
        'incomplete_details' => null,
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
                'type' => 'file_search',
            ],
        ],
        'metadata' => [],
        'temperature' => 1.0,
        'top_p' => 1.0,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => 'none',
        'response_format' => [
            'type' => 'json_object',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunWithUsageResource(): array
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
        'incomplete_details' => null,
        'last_error' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'metadata' => [],
        'usage' => [
            'prompt_tokens' => 1,
            'completion_tokens' => 16,
            'total_tokens' => 17,
        ],
        'temperature' => 1.0,
        'top_p' => 1.0,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => 'none',
        'response_format' => 'auto',
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunWithIncompleteDetails(): array
{
    return [
        'id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'object' => 'thread.run',
        'created_at' => 1699621735,
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_EKt7MjGOC6bwKWmenQv5VD6r',
        'status' => 'incomplete',
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
        'metadata' => [],
        'usage' => [
            'prompt_tokens' => 1,
            'completion_tokens' => 16,
            'total_tokens' => 17,
        ],
        'incomplete_details' => [
            'reason' => 'Input tokens exceeded',
        ],
        'temperature' => 1,
        'top_p' => 1,
        'max_prompt_tokens' => 600,
        'max_completion_tokens' => 500,
        'truncation_strategy' => [
            'type' => 'auto',
            'last_messages' => null,
        ],
        'tool_choice' => 'none',
        'response_format' => 'auto',
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
