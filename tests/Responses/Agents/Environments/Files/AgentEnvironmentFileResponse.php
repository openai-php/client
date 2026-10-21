<?php

use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;

test('from', function () {
    $result = AgentEnvironmentFileResponse::from(agentEnvironmentFileResource(), meta());

    expect($result)
        ->object->toBe('agent.environment.file')
        ->environmentId->toBe('env_abc123')
        ->path->toBe('/workspace/hello.txt')
        ->sizeBytes->toBe(6);
});

test('as array accessible', function () {
    $result = AgentEnvironmentFileResponse::from(agentEnvironmentFileResource(), meta());

    expect($result['path'])
        ->toBe('/workspace/hello.txt');
});

test('to array', function () {
    $result = AgentEnvironmentFileResponse::from(agentEnvironmentFileResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentFileResource());
});

test('fake', function () {
    $response = AgentEnvironmentFileResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentFileResponse::class)
        ->object->toBe('agent.environment.file');
});
