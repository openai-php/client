<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputProgramOutputFixture
{
    public const ATTRIBUTES = [
        'type' => 'program_output',
        'id' => 'prog_out_123',
        'call_id' => 'call_prog_123',
        'result' => '{"sku":"sku_123","available_units":42}',
        'status' => 'completed',
    ];
}
