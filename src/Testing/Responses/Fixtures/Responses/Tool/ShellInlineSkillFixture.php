<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Tool;

final class ShellInlineSkillFixture
{
    public const ATTRIBUTES = [
        'type' => 'inline',
        'name' => 'sandbox-word-count',
        'description' => 'Count words in a supplied text.',
        'source' => [
            'type' => 'base64',
            'media_type' => 'application/zip',
            'data' => 'UEsFBgAAAAAAAAAAAAAAAAAAAAAAAA==',
        ],
    ];
}
