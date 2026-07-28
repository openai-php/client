<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputApplyPatchToolCallFixture
{
    public const ATTRIBUTES = [
        'id' => 'apc_123',
        'call_id' => 'call_123',
        'operation' => [
            'type' => 'update_file',
            'diff' => "@@\n-old line\n+new line",
            'path' => 'src/Example.php',
        ],
        'status' => 'completed',
        'type' => 'apply_patch_call',
        'caller' => [
            'type' => 'direct',
        ],
        'created_by' => 'user_123',
    ];
}
