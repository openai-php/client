<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class ShellCallOutputContentDeltaFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.shell_call_output_content.delta',
        'command_index' => 0,
        'output_index' => 0,
        'sequence_number' => 1,
        'item_id' => 'sho_123',
        'delta' => [
            'stdout' => '{"skill":"sandbox-word-count","word_count":7}',
        ],
    ];
}
