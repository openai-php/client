<?php

use OpenAI\Resources\Agents;
use OpenAI\Responses\Agents\AgentDeleteResponse;
use OpenAI\Responses\Agents\AgentListResponse;
use OpenAI\Responses\Agents\AgentResponse;
use OpenAI\Testing\ClientFake;

it('records an agents create request', function () {
    $fake = new ClientFake([
        AgentResponse::fake(),
    ]);

    $fake->agents()->create([
        'model' => 'gpt-5.4',
    ]);

    $fake->assertSent(Agents::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-5.4';
    });
});

it('records an agents list request', function () {
    $fake = new ClientFake([
        AgentListResponse::fake(),
    ]);

    $fake->agents()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(Agents::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 10;
    });
});

it('records an agents retrieve request', function () {
    $fake = new ClientFake([
        AgentResponse::fake(),
    ]);

    $fake->agents()->retrieve('agent_abc123');

    $fake->assertSent(Agents::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'agent_abc123';
    });
});

it('records an agents update request', function () {
    $fake = new ClientFake([
        AgentResponse::fake(),
    ]);

    $fake->agents()->update('agent_abc123', [
        'name' => 'Support Agent',
    ]);

    $fake->assertSent(Agents::class, function ($method, $id, $parameters) {
        return $method === 'update' &&
            $id === 'agent_abc123' &&
            $parameters['name'] === 'Support Agent';
    });
});

it('records an agents delete request', function () {
    $fake = new ClientFake([
        AgentDeleteResponse::fake(),
    ]);

    $fake->agents()->delete('agent_abc123');

    $fake->assertSent(Agents::class, function ($method, $id) {
        return $method === 'delete' &&
            $id === 'agent_abc123';
    });
});
