<?php

use OpenAI\Responses\Agents\AgentDeleteResponse;
use OpenAI\Responses\Agents\AgentListResponse;
use OpenAI\Responses\Agents\AgentResponse;
use OpenAI\Responses\Agents\Objects\MultiAgent;
use OpenAI\Responses\Agents\Objects\Reasoning;
use OpenAI\Responses\Agents\Objects\Text;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'agents', [
        'model' => 'gpt-5.4',
        'name' => 'Support Agent',
        'instructions' => 'Answer billing questions.',
    ], Response::from(agentResource(), metaHeaders()));

    $result = $client->agents()->create([
        'model' => 'gpt-5.4',
        'name' => 'Support Agent',
        'instructions' => 'Answer billing questions.',
    ]);

    expect($result)
        ->toBeInstanceOf(AgentResponse::class)
        ->id->toBe('agent_abc123')
        ->object->toBe('agent')
        ->createdAt->toBe(1760000000)
        ->updatedAt->toBe(1760000100)
        ->model->toBe('gpt-5.4')
        ->name->toBe('Support Agent')
        ->instructions->toBe('Answer billing questions.')
        ->metadata->toBe(['team' => 'billing'])
        ->multiAgent->toBeInstanceOf(MultiAgent::class)
        ->reasoning->toBeInstanceOf(Reasoning::class)
        ->serviceTier->toBe('auto')
        ->text->toBeInstanceOf(Text::class)
        ->tools->toHaveCount(3);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'agents', [
        'limit' => 10,
    ], Response::from(agentListResource(), metaHeaders()));

    $result = $client->agents()->list([
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(AgentListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentResponse::class)
        ->firstId->toBe('agent_abc123')
        ->lastId->toBe('agent_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'agents/agent_abc123', [], Response::from(agentResource(), metaHeaders()));

    $result = $client->agents()->retrieve('agent_abc123');

    expect($result)
        ->toBeInstanceOf(AgentResponse::class)
        ->id->toBe('agent_abc123')
        ->name->toBe('Support Agent');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'agents/agent_abc123', [
        'name' => 'Support Agent',
    ], Response::from(agentResource(), metaHeaders()));

    $result = $client->agents()->update('agent_abc123', [
        'name' => 'Support Agent',
    ]);

    expect($result)
        ->toBeInstanceOf(AgentResponse::class)
        ->id->toBe('agent_abc123')
        ->name->toBe('Support Agent');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'agents/agent_abc123', [], Response::from(agentDeleteResource(), metaHeaders()));

    $result = $client->agents()->delete('agent_abc123');

    expect($result)
        ->toBeInstanceOf(AgentDeleteResponse::class)
        ->id->toBe('agent_abc123')
        ->object->toBe('agent.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
