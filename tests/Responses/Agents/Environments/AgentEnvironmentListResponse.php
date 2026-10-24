<?php

use OpenAI\Responses\Agents\Environments\AgentEnvironmentListResponse;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;

test('from', function () {
    $result = AgentEnvironmentListResponse::from(agentEnvironmentListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentEnvironmentResponse::class)
        ->firstId->toBe('env_abc123')
        ->lastId->toBe('env_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = AgentEnvironmentListResponse::from(agentEnvironmentListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = AgentEnvironmentListResponse::from(agentEnvironmentListResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentListResource());
});

test('fake', function () {
    $response = AgentEnvironmentListResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentListResponse::class)
        ->data->each->toBeInstanceOf(AgentEnvironmentResponse::class);
});
