<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Tool;

final class ApplyPatchToolFixture
{
    public const ATTRIBUTES = [
        'type' => 'apply_patch',
        'allowed_callers' => [
            'direct',
            'programmatic',
        ],
    ];
}
