<?php

use OpenAI\Resources\AgentEnvironmentFiles;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileListResponse;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;
use OpenAI\Testing\ClientFake;

it('records an agent environment files create request', function () {
    $fake = new ClientFake([
        AgentEnvironmentFileResponse::fake(),
    ]);

    $fake->agents()->environments()->files()->create('env_abc123', [
        'type' => 'inline',
        'path' => '/workspace/hello.txt',
        'data' => 'aGVsbG8K',
    ]);

    $fake->assertSent(AgentEnvironmentFiles::class, function ($method, $environmentId, $parameters) {
        return $method === 'create' &&
            $environmentId === 'env_abc123' &&
            $parameters['path'] === '/workspace/hello.txt';
    });
});

it('records an agent environment files list request', function () {
    $fake = new ClientFake([
        AgentEnvironmentFileListResponse::fake(),
    ]);

    $fake->agents()->environments()->files()->list('env_abc123');

    $fake->assertSent(AgentEnvironmentFiles::class, function ($method, $environmentId) {
        return $method === 'list' &&
            $environmentId === 'env_abc123';
    });
});
