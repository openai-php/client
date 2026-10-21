<?php

use OpenAI\Responses\Agents\Environments\Objects\Desktop;
use OpenAI\Responses\Agents\Environments\Objects\Network;
use OpenAI\Responses\Agents\Environments\Objects\Packages;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;

test('from', function () {
    $result = AgentEnvironmentTemplateResponse::from(agentEnvironmentTemplateResource(), meta());

    expect($result)
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
});

test('from with nested objects and defaults', function () {
    $result = AgentEnvironmentTemplateResponse::from(agentEnvironmentTemplateResource(), meta());

    expect($result->network)
        ->access->toBe('restricted')
        ->allowedDomains->toBe(['pypi.org', 'files.pythonhosted.org']);
    expect($result->packages->python)->toBe(['requests']);
    expect($result->skills[0])->toBe(['type' => 'skill_reference', 'skill_id' => 'skill_abc123', 'version' => null]);

    $bare = AgentEnvironmentTemplateResponse::from(agentEnvironmentTemplateListResource()['data'][1], meta());

    expect($bare)
        ->name->toBeNull()
        ->files->toBe([]);
    expect($bare->network->access)->toBe('enabled');
});

test('as array accessible', function () {
    $result = AgentEnvironmentTemplateResponse::from(agentEnvironmentTemplateResource(), meta());

    expect($result['name'])
        ->toBe('Python data tools');
});

test('to array', function () {
    $result = AgentEnvironmentTemplateResponse::from(agentEnvironmentTemplateResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentTemplateResource());
});

test('fake', function () {
    $response = AgentEnvironmentTemplateResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentTemplateResponse::class)
        ->object->toBe('agent.environment.template');
});
