<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputShellCallFixture
{
    public const ATTRIBUTES = [
        'id' => 'sh_123',
        'type' => 'shell_call',
        'status' => 'completed',
        'call_id' => 'call_123',
        'action' => [
            'commands' => [
                'python /skills/sandbox-word-count/scripts/count_words.py /mnt/data/sample.txt',
            ],
            'max_output_length' => 4096,
            'timeout_ms' => 120000,
        ],
        'environment' => [
            'type' => 'container_reference',
            'container_id' => 'cntr_123',
        ],
    ];
}
