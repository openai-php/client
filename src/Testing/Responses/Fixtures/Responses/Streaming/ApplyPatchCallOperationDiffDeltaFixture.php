<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class ApplyPatchCallOperationDiffDeltaFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.apply_patch_call_operation_diff.delta',
        'delta' => "@@\n-old line\n+new line",
        'item_id' => 'apc_123',
        'output_index' => 0,
        'sequence_number' => 2,
        'obfuscation' => 'obfuscated_123',
    ];
}
