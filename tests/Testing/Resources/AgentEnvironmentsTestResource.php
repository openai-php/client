<?php

use OpenAI\Resources\AgentEnvironments;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentListResponse;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;
use OpenAI\Testing\ClientFake;

it('records an agent environments create request', function () {
    $fake = new ClientFake([
        AgentEnvironmentResponse::fake(),
    ]);

    $fake->agents()->environments()->create([
        'environment' => ['type' => 'openai_hosted'],
    ]);

    $fake->assertSent(AgentEnvironments::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['environment']['type'] === 'openai_hosted';
    });
});

it('records an agent environments list request', function () {
    $fake = new ClientFake([
        AgentEnvironmentListResponse::fake(),
    ]);

    $fake->agents()->environments()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(AgentEnvironments::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 10;
    });
});

it('records an agent environments retrieve request', function () {
    $fake = new ClientFake([
        AgentEnvironmentResponse::fake(),
    ]);

    $fake->agents()->environments()->retrieve('env_abc123');

    $fake->assertSent(AgentEnvironments::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'env_abc123';
    });
});
