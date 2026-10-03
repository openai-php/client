<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class ShellCallOutputContentDoneFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.shell_call_output_content.done',
        'command_index' => 0,
        'output_index' => 0,
        'sequence_number' => 1,
        'item_id' => 'sho_123',
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
    ];
}
