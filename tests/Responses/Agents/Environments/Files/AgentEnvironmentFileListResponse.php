<?php

use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileListResponse;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;

test('from', function () {
    $result = AgentEnvironmentFileListResponse::from(agentEnvironmentFileListResource(), meta());

    expect($result)
        ->object->toBe('page')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentEnvironmentFileResponse::class)
        ->hasMore->toBeTrue()
        ->next->toBe('cursor_abc123');
});

test('as array accessible', function () {
    $result = AgentEnvironmentFileListResponse::from(agentEnvironmentFileListResource(), meta());

    expect($result['next'])
        ->toBe('cursor_abc123');
});

test('to array', function () {
    $result = AgentEnvironmentFileListResponse::from(agentEnvironmentFileListResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentFileListResource());
});

test('fake', function () {
    $response = AgentEnvironmentFileListResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentFileListResponse::class)
        ->data->each->toBeInstanceOf(AgentEnvironmentFileResponse::class);
});
