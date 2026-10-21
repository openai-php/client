<?php

use OpenAI\Responses\Agents\Environments\Objects\Desktop;
use OpenAI\Responses\Agents\Environments\Objects\Network;
use OpenAI\Responses\Agents\Environments\Objects\Packages;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateDeleteResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateListResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'agents/environments/templates', [
        'name' => 'Python data tools',
        'packages' => ['python' => ['requests']],
        'setup_commands' => [['command' => 'pip list']],
    ], Response::from(agentEnvironmentTemplateResource(), metaHeaders()));

    $result = $client->agents()->environments()->templates()->create([
        'name' => 'Python data tools',
        'packages' => ['python' => ['requests']],
        'setup_commands' => [['command' => 'pip list']],
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentTemplateResponse::class)
        ->id->toBe('envtmpl_abc123')
        ->object->toBe('agent.environment.template')
        ->createdAt->toBe(1792600518)
        ->updatedAt->toBe(1792600520)
        ->name->toBe('Python data tools')
        ->capabilityDirectories->toBe(['/workspace/capabilities'])
        ->desktop->toBeInstanceOf(Desktop::class)
        ->network->toBeInstanceOf(Network::class)
        ->packages->toBeInstanceOf(Packages::class)
        ->files->toHaveCount(2)
        ->plugins->toHaveCount(1)
        ->skills->toHaveCount(2);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'agents/environments/templates', [
        'limit' => 10,
    ], Response::from(agentEnvironmentTemplateListResource(), metaHeaders()));

    $result = $client->agents()->environments()->templates()->list([
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentTemplateListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentEnvironmentTemplateResponse::class)
        ->firstId->toBe('envtmpl_abc123')
        ->lastId->toBe('envtmpl_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'agents/environments/templates/envtmpl_abc123', [], Response::from(agentEnvironmentTemplateResource(), metaHeaders()));

    $result = $client->agents()->environments()->templates()->retrieve('envtmpl_abc123');

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentTemplateResponse::class)
        ->id->toBe('envtmpl_abc123')
        ->name->toBe('Python data tools');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'agents/environments/templates/envtmpl_abc123', [
        'desktop' => ['enabled' => true],
    ], Response::from(agentEnvironmentTemplateResource(), metaHeaders()));

    $result = $client->agents()->environments()->templates()->update('envtmpl_abc123', [
        'desktop' => ['enabled' => true],
    ]);

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentTemplateResponse::class)
        ->id->toBe('envtmpl_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'agents/environments/templates/envtmpl_abc123', [], Response::from(agentEnvironmentTemplateDeleteResource(), metaHeaders()));

    $result = $client->agents()->environments()->templates()->delete('envtmpl_abc123');

    expect($result)
        ->toBeInstanceOf(AgentEnvironmentTemplateDeleteResponse::class)
        ->id->toBe('envtmpl_abc123')
        ->object->toBe('agent.environment.template.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
