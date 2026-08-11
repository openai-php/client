<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Input;

final class ApplyPatchToolCallOutputFixture
{
    public const ATTRIBUTES = [
        'id' => 'apco_123',
        'call_id' => 'call_123',
        'status' => 'completed',
        'type' => 'apply_patch_call_output',
        'caller' => [
            'type' => 'direct',
        ],
        'created_by' => 'user_123',
        'output' => 'Patch applied successfully.',
    ];
}
