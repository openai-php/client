<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputShellCallOutputFixture
{
    public const ATTRIBUTES = [
        'id' => 'sho_123',
        'type' => 'shell_call_output',
        'status' => 'completed',
        'call_id' => 'call_123',
        'output' => [
            [
                'stdout' => '{"skill":"sandbox-word-count","word_count":7}',
                'stderr' => '',
                'outcome' => [
                    'type' => 'exit',
                    'exit_code' => 0,
                ],
            ],
        ],
        'max_output_length' => 4096,
    ];
}
