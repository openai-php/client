<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class ApplyPatchCallOperationDiffDoneFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.apply_patch_call_operation_diff.done',
        'diff' => "@@\n-old line\n+new line",
        'item_id' => 'apc_123',
        'output_index' => 0,
        'sequence_number' => 3,
    ];
}
