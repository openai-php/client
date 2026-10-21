<?php

test('create', function () {
    $client = mockContentClient('POST', 'agents/sessions/sess_abc123/events', [
        'events' => [[
            'type' => 'agent.session.input.message',
            'input' => [[
                'role' => 'user',
                'content' => [['type' => 'input_text', 'text' => 'Summarise the latest invoice.']],
            ]],
        ]],
    ], '');

    $result = $client->agents()->sessions()->events()->create('sess_abc123', [
        'events' => [[
            'type' => 'agent.session.input.message',
            'input' => [[
                'role' => 'user',
                'content' => [['type' => 'input_text', 'text' => 'Summarise the latest invoice.']],
            ]],
        ]],
    ]);

    expect($result)->toBeNull();
});
