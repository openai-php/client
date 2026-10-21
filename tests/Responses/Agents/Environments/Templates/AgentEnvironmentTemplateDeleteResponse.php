<?php

use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateDeleteResponse;

test('from', function () {
    $result = AgentEnvironmentTemplateDeleteResponse::from(agentEnvironmentTemplateDeleteResource(), meta());

    expect($result)
        ->id->toBe('envtmpl_abc123')
        ->object->toBe('agent.environment.template.deleted')
        ->deleted->toBeTrue();
});

test('as array accessible', function () {
    $result = AgentEnvironmentTemplateDeleteResponse::from(agentEnvironmentTemplateDeleteResource(), meta());

    expect($result['deleted'])
        ->toBe(true);
});

test('to array', function () {
    $result = AgentEnvironmentTemplateDeleteResponse::from(agentEnvironmentTemplateDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentTemplateDeleteResource());
});

test('fake', function () {
    $response = AgentEnvironmentTemplateDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentTemplateDeleteResponse::class)
        ->deleted->toBeTrue();
});
