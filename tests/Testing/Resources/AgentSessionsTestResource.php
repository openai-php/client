<?php

use OpenAI\Resources\AgentSessions;
use OpenAI\Responses\Agents\Sessions\AgentSessionDeleteResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionListResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;
use OpenAI\Testing\ClientFake;

it('records an agent sessions create request', function () {
    $fake = new ClientFake([
        AgentSessionResponse::fake(),
    ]);

    $fake->agents()->sessions()->create([
        'environment' => ['type' => 'none'],
        'input' => 'Hello',
    ]);

    $fake->assertSent(AgentSessions::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['input'] === 'Hello';
    });
});

it('records an agent sessions list request', function () {
    $fake = new ClientFake([
        AgentSessionListResponse::fake(),
    ]);

    $fake->agents()->sessions()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(AgentSessions::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 10;
    });
});

it('records an agent sessions retrieve request', function () {
    $fake = new ClientFake([
        AgentSessionResponse::fake(),
    ]);

    $fake->agents()->sessions()->retrieve('sess_abc123');

    $fake->assertSent(AgentSessions::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'sess_abc123';
    });
});

it('records an agent sessions update request', function () {
    $fake = new ClientFake([
        AgentSessionResponse::fake(),
    ]);

    $fake->agents()->sessions()->update('sess_abc123', [
        'metadata' => ['purpose' => 'support'],
    ]);

    $fake->assertSent(AgentSessions::class, function ($method, $id, $parameters) {
        return $method === 'update' &&
            $id === 'sess_abc123' &&
            $parameters['metadata'] === ['purpose' => 'support'];
    });
});

it('records an agent sessions delete request', function () {
    $fake = new ClientFake([
        AgentSessionDeleteResponse::fake(),
    ]);

    $fake->agents()->sessions()->delete('sess_abc123');

    $fake->assertSent(AgentSessions::class, function ($method, $id) {
        return $method === 'delete' &&
            $id === 'sess_abc123';
    });
});
