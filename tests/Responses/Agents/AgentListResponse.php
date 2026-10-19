<?php

use OpenAI\Responses\Agents\AgentListResponse;
use OpenAI\Responses\Agents\AgentResponse;

test('from', function () {
    $result = AgentListResponse::from(agentListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentResponse::class)
        ->firstId->toBe('agent_abc123')
        ->lastId->toBe('agent_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = AgentListResponse::from(agentListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = AgentListResponse::from(agentListResource(), meta());

    expect($result->toArray())
        ->toBe(agentListResource());
});

test('fake', function () {
    $response = AgentListResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentListResponse::class)
        ->data->each->toBeInstanceOf(AgentResponse::class);
});
