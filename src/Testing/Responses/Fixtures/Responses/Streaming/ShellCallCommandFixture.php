<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class ShellCallCommandFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.shell_call_command.added',
        'command_index' => 0,
        'output_index' => 0,
        'sequence_number' => 1,
        'command' => 'python /skills/sandbox-word-count/scripts/count_words.py /mnt/data/sample.txt',
    ];
}
