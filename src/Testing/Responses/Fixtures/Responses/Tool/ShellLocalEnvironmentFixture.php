<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Tool;

final class ShellLocalEnvironmentFixture
{
    public const ATTRIBUTES = [
        'type' => 'local',
        'skills' => [
            [
                'name' => 'sandbox-word-count',
                'description' => 'Count words in a supplied text.',
                'path' => '/skills/sandbox-word-count',
            ],
        ],
    ];
}
