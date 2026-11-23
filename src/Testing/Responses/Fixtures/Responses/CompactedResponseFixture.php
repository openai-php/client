<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses;

final class CompactedResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'resp_001',
        'object' => 'response.compaction',
        'created_at' => 1764967971,
        'output' => [
            [
                'id' => 'msg_000',
                'type' => 'message',
                'status' => 'completed',
                'content' => [
                    [
                        'type' => 'input_text',
                        'text' => 'Create a simple landing page for a dog petting cafe.',
                    ],
                ],
                'role' => 'user',
            ],
            [
                'id' => 'cmp_001',
                'type' => 'compaction',
                'encrypted_content' => 'gAAAAABpM0Yj-...=',
            ],
        ],
        'usage' => [
            'input_tokens' => 139,
            'input_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'output_tokens' => 438,
            'output_tokens_details' => [
                'reasoning_tokens' => 64,
            ],
            'total_tokens' => 577,
        ],
    ];
}
