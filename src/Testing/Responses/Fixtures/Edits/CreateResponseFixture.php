<?php

namespace OpenAI\Testing\Responses\Fixtures\Edits;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'edit',
        'created' => 1_664_135_921,
        'choices' => [[
            'text' => "What day of the week is it?\n",
            'index' => 0,
        ]],
        'usage' => [
            'prompt_tokens' => 25,
            'completion_tokens' => 28,
            'total_tokens' => 53,
        ],
    ];
}
