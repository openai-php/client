<?php

use OpenAI\Responses\Agents\Sessions\AgentSessionListResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;

test('from', function () {
    $result = AgentSessionListResponse::from(agentSessionListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentSessionResponse::class)
        ->firstId->toBe('sess_abc123')
        ->lastId->toBe('sess_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = AgentSessionListResponse::from(agentSessionListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = AgentSessionListResponse::from(agentSessionListResource(), meta());

    expect($result->toArray())
        ->toBe(agentSessionListResource());
});

test('fake', function () {
    $response = AgentSessionListResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentSessionListResponse::class)
        ->data->each->toBeInstanceOf(AgentSessionResponse::class);
});
