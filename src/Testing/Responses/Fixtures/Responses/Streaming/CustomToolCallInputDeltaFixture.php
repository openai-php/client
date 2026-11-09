<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class CustomToolCallInputDeltaFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.custom_tool_call_input.delta',
        'delta' => 'print("hello',
        'item_id' => 'ctc_123',
        'output_index' => 0,
        'sequence_number' => 2,
    ];
}
