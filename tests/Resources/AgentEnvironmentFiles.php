<?php

use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileListResponse;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'agents/environments/env_abc123/files', [
        'type' => 'inline',
        'path' => '/workspace/hello.txt',
        'data' => 'aGVsbG8K',
    ], Response::from(agentEnvironmentFileResource(), metaHeaders()));

    $result = $client->agents()->environments()->files()->create('env_abc123', [
        'type' => 'inline',
        'path' => '/workspace/hello.txt',
        'data' => 'aGVsbG8K',
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentFileResponse::class)
        ->object->toBe('agent.environment.file')
        ->environmentId->toBe('env_abc123')
        ->path->toBe('/workspace/hello.txt')
        ->sizeBytes->toBe(6);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'agents/environments/env_abc123/files', [
        'path' => '/workspace',
        'page' => 'cursor_abc123',
    ], Response::from(agentEnvironmentFileListResource(), metaHeaders()));

    $result = $client->agents()->environments()->files()->list('env_abc123', [
        'path' => '/workspace',
        'page' => 'cursor_abc123',
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentFileListResponse::class)
        ->object->toBe('page')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentEnvironmentFileResponse::class)
        ->hasMore->toBeTrue()
        ->next->toBe('cursor_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
