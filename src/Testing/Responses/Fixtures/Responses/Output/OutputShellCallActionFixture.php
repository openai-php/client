<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputShellCallActionFixture
{
    public const ATTRIBUTES = [
        'commands' => [
            'python /skills/sandbox-word-count/scripts/count_words.py /mnt/data/sample.txt',
        ],
        'max_output_length' => 4096,
        'timeout_ms' => 120000,
    ];
}
