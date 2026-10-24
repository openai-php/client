<?php

use OpenAI\Resources\AgentEnvironmentTemplates;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateDeleteResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateListResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;
use OpenAI\Testing\ClientFake;

it('records an agent environment templates create request', function () {
    $fake = new ClientFake([
        AgentEnvironmentTemplateResponse::fake(),
    ]);

    $fake->agents()->environments()->templates()->create([
        'name' => 'Python data tools',
    ]);

    $fake->assertSent(AgentEnvironmentTemplates::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['name'] === 'Python data tools';
    });
});

it('records an agent environment templates list request', function () {
    $fake = new ClientFake([
        AgentEnvironmentTemplateListResponse::fake(),
    ]);

    $fake->agents()->environments()->templates()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(AgentEnvironmentTemplates::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 10;
    });
});

it('records an agent environment templates retrieve request', function () {
    $fake = new ClientFake([
        AgentEnvironmentTemplateResponse::fake(),
    ]);

    $fake->agents()->environments()->templates()->retrieve('envtmpl_abc123');

    $fake->assertSent(AgentEnvironmentTemplates::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'envtmpl_abc123';
    });
});

it('records an agent environment templates update request', function () {
    $fake = new ClientFake([
        AgentEnvironmentTemplateResponse::fake(),
    ]);

    $fake->agents()->environments()->templates()->update('envtmpl_abc123', [
        'name' => 'Python data tools (updated)',
    ]);

    $fake->assertSent(AgentEnvironmentTemplates::class, function ($method, $id, $parameters) {
        return $method === 'update' &&
            $id === 'envtmpl_abc123' &&
            $parameters['name'] === 'Python data tools (updated)';
    });
});

it('records an agent environment templates delete request', function () {
    $fake = new ClientFake([
        AgentEnvironmentTemplateDeleteResponse::fake(),
    ]);

    $fake->agents()->environments()->templates()->delete('envtmpl_abc123');

    $fake->assertSent(AgentEnvironmentTemplates::class, function ($method, $id) {
        return $method === 'delete' &&
            $id === 'envtmpl_abc123';
    });
});
