<?php

namespace OpenAI\Testing\Responses\Fixtures\Edits;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'edit',
        'created' => 1_664_135_921,
        'choices' => [[
            'text' => "This is a fake edit response.\n",
            'index' => 0,
        ]],
        'usage' => [
            'prompt_tokens' => 25,
            'completion_tokens' => 30,
            'total_tokens' => 55,
        ],
    ];
}
