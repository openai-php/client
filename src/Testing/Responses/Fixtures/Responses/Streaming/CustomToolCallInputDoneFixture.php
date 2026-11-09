<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Streaming;

final class CustomToolCallInputDoneFixture
{
    public const ATTRIBUTES = [
        'type' => 'response.custom_tool_call_input.done',
        'input' => 'print("hello world")',
        'item_id' => 'ctc_123',
        'output_index' => 0,
        'sequence_number' => 3,
    ];
}
