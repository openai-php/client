<?php

use OpenAI\Responses\Agents\Environments\AgentEnvironmentListResponse;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'agents/environments', [
        'environment' => [
            'type' => 'openai_hosted',
            'environment_template_id' => 'envtmpl_abc123',
        ],
    ], Response::from(agentEnvironmentResource(), metaHeaders()));

    $result = $client->agents()->environments()->create([
        'environment' => [
            'type' => 'openai_hosted',
            'environment_template_id' => 'envtmpl_abc123',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentResponse::class)
        ->id->toBe('env_abc123')
        ->object->toBe('agent.environment')
        ->type->toBe('openai_hosted')
        ->status->toBe('ready')
        ->files->toHaveCount(2)
        ->plugins->toHaveCount(1)
        ->skills->toHaveCount(2);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'agents/environments', [
        'limit' => 10,
    ], Response::from(agentEnvironmentListResource(), metaHeaders()));

    $result = $client->agents()->environments()->list([
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentEnvironmentResponse::class)
        ->firstId->toBe('env_abc123')
        ->lastId->toBe('env_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'agents/environments/env_abc123', [], Response::from(agentEnvironmentResource(), metaHeaders()));

    $result = $client->agents()->environments()->retrieve('env_abc123');

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentResponse::class)
        ->id->toBe('env_abc123')
        ->status->toBe('ready');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
