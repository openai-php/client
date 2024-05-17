<?php

namespace OpenAI\Testing\Responses\Fixtures\Threads\Runs\Steps;

final class ThreadRunStepListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
                'object' => 'thread.run.step',
                'created_at' => 1_699_564_106,
                'run_id' => 'run_fYijubpOJsKDnvtACWBS8C8r',
                'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
                'thread_id' => 'thread_3WdOgtVuhD8aUIEx774Whkvo',
                'type' => 'message_creation',
                'status' => 'completed',
                'cancelled_at' => null,
                'completed_at' => 1_699_564_119,
                'expires_at' => null,
                'failed_at' => null,
                'last_error' => null,
                'step_details' => [
                    'type' => 'message_creation',
                    'message_creation' => [
                        'message_id' => 'msg_i404PxKbB92d0JAmdOIcX7vA',
                    ],
                ],
                'usage' => [
                    'prompt_tokens' => 123,
                    'completion_tokens' => 456,
                    'total_tokens' => 579,
                ],
            ],
        ],
        'first_id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
        'last_id' => 'step_1spQXgbAabXFm1YXrwiGIMUz',
        'has_more' => false,
    ];
}
