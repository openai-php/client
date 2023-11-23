<?php

/**
 * @return array<string, mixed>
 */
function threadRunStepResource(): array
{
    return [
        'id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
        'object' => 'thread.run.step',
        'created_at' => 1699564106,
        'run_id' => 'run_fYijubpOJsKDnvtACWBS8C8r',
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_3WdOgtVuhD8aUIEx774Whkvo',
        'type' => 'message_creation',
        'status' => 'completed',
        'cancelled_at' => null,
        'completed_at' => 1699564119,
        'expires_at' => null,
        'failed_at' => null,
        'last_error' => null,
        'step_details' => [
            'type' => 'message_creation',
            'message_creation' => [
                'message_id' => 'msg_i404PxKbB92d0JAmdOIcX7vA',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunStepWithCodeInterpreterOutputResource(): array
{
    return [
        'id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
        'object' => 'thread.run.step',
        'created_at' => 1699564106,
        'run_id' => 'run_fYijubpOJsKDnvtACWBS8C8r',
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_3WdOgtVuhD8aUIEx774Whkvo',
        'type' => 'message_creation',
        'status' => 'completed',
        'cancelled_at' => null,
        'completed_at' => 1699564119,
        'expires_at' => null,
        'failed_at' => null,
        'last_error' => null,
        'step_details' => [
            'type' => 'tool_calls',
            'tool_calls' => [
                [
                    'id' => 'call_KSg14X7kZF2WDzlPhpQ168Mj',
                    'type' => 'code_interpreter',
                    'code_interpreter' => [
                        'input' => 'The input string.',
                        'outputs' => [
                            [
                                'type' => 'image',
                                'image' => [
                                    'file_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
                                ],
                            ],
                            [
                                'type' => 'logs',
                                'logs' => 'The log output content.',
                            ],
                        ],
                    ],
                ],
                [
                    'id' => 'call_Fbg14X7kZF2WDzlPhpQ167De',
                    'type' => 'function',
                    'function' => [
                        'name' => 'add',
                        'arguments' => '{ "a": 5, "b": 7 }',
                        'output' => '12',
                    ],
                ],
                [
                    'id' => 'call_mNs14X7kZF2WDzlPhpQ163Co',
                    'type' => 'retrieval',
                    'retrieval' => [],
                ],
            ],
        ],
        'metadata' => ['name' => 'the step name'],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadRunStepListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            threadRunStepResource(),
            threadRunStepResource(),
        ],
        'first_id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
        'last_id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
        'has_more' => false,
    ];
}
