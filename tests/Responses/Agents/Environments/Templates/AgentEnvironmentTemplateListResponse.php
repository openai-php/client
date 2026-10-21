<?php

use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateListResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;

test('from', function () {
    $result = AgentEnvironmentTemplateListResponse::from(agentEnvironmentTemplateListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(AgentEnvironmentTemplateResponse::class)
        ->firstId->toBe('envtmpl_abc123')
        ->lastId->toBe('envtmpl_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = AgentEnvironmentTemplateListResponse::from(agentEnvironmentTemplateListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = AgentEnvironmentTemplateListResponse::from(agentEnvironmentTemplateListResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentTemplateListResource());
});

test('fake', function () {
    $response = AgentEnvironmentTemplateListResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentTemplateListResponse::class)
        ->data->each->toBeInstanceOf(AgentEnvironmentTemplateResponse::class);
});
