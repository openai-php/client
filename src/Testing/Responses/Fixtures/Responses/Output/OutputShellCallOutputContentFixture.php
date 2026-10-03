<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputShellCallOutputContentFixture
{
    public const ATTRIBUTES = [
        'stdout' => '{"skill":"sandbox-word-count","word_count":7}',
        'stderr' => '',
        'outcome' => [
            'type' => 'exit',
            'exit_code' => 0,
        ],
    ];
}
