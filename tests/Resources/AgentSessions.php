<?php

use OpenAI\Responses\Agents\Sessions\AgentSessionDeleteResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionListResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'agents/sessions', [
        'environment' => ['type' => 'none'],
        'agent_id' => 'agent_abc123',
        'input' => 'Summarise the latest invoice.',
    ], Response::from(agentSessionResource(), metaHeaders()));

    $result = $client->agents()->sessions()->create([
        'environment' => ['type' => 'none'],
        'agent_id' => 'agent_abc123',
        'input' => 'Summarise the latest invoice.',
    ]);

    expect($result)
        ->toBeInstanceOf(AgentSessionResponse::class)
        ->id->toBe('sess_abc123')
        ->object->toBe('agent.session')
        ->status->toBe('idle');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'agents/sessions', [
        'agent_id' => 'agent_abc123',
        'limit' => 10,
    ], Response::from(agentSessionListResource(), metaHeaders()));

    $result = $client->agents()->sessions()->list([
        'agent_id' => 'agent_abc123',
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(AgentSessionListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentSessionResponse::class)
        ->firstId->toBe('sess_abc123')
        ->lastId->toBe('sess_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'agents/sessions/sess_abc123', [], Response::from(agentSessionResource(), metaHeaders()));

    $result = $client->agents()->sessions()->retrieve('sess_abc123');

    expect($result)
        ->toBeInstanceOf(AgentSessionResponse::class)
        ->id->toBe('sess_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'agents/sessions/sess_abc123', [
        'agent' => ['reasoning' => ['effort' => 'low']],
    ], Response::from(agentSessionResource(), metaHeaders()));

    $result = $client->agents()->sessions()->update('sess_abc123', [
        'agent' => ['reasoning' => ['effort' => 'low']],
    ]);

    expect($result)
        ->toBeInstanceOf(AgentSessionResponse::class)
        ->id->toBe('sess_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'agents/sessions/sess_abc123', [], Response::from(agentSessionDeleteResource(), metaHeaders()));

    $result = $client->agents()->sessions()->delete('sess_abc123');

    expect($result)
        ->toBeInstanceOf(AgentSessionDeleteResponse::class)
        ->id->toBe('sess_abc123')
        ->object->toBe('agent.session.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
