<?php

use OpenAI\Resources\AgentSessionEvents;
use OpenAI\Testing\ClientFake;

it('records an agent session events create request', function () {
    $fake = new ClientFake([
        '',
    ]);

    $fake->agents()->sessions()->events()->create('sess_abc123', [
        'events' => [['type' => 'agent.session.input.cancel']],
    ]);

    $fake->assertSent(AgentSessionEvents::class, function ($method, $sessionId, $parameters) {
        return $method === 'create' &&
            $sessionId === 'sess_abc123' &&
            $parameters['events'][0]['type'] === 'agent.session.input.cancel';
    });
});
