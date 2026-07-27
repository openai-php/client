<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output;

final class OutputProgramFixture
{
    public const ATTRIBUTES = [
        'type' => 'program',
        'id' => 'prog_123',
        'call_id' => 'call_prog_123',
        'code' => "const stock = await tools.get_inventory({ sku: 'sku_123' }); text(JSON.stringify(stock));",
        'fingerprint' => 'opaque_replay_state',
    ];
}
