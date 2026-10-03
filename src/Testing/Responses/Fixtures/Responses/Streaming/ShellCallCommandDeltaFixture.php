<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class ShellCallCommandDeltaFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.shell_call_command.delta',
        'command_index' => 0,
        'output_index' => 0,
        'sequence_number' => 1,
        'delta' => 'python ',
        'obfuscation' => 'abc',
    ];
}
