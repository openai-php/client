<?php

use OpenAI\Responses\Agents\AgentResponse;
use OpenAI\Responses\Agents\Objects\MultiAgent;
use OpenAI\Responses\Agents\Objects\Reasoning;
use OpenAI\Responses\Agents\Objects\Text;

test('from', function () {
    $result = AgentResponse::from(agentResource(), meta());

    expect($result)
        ->id->toBe('agent_abc123')
        ->object->toBe('agent')
        ->createdAt->toBe(1760000000)
        ->updatedAt->toBe(1760000100)
        ->model->toBe('gpt-5.4')
        ->name->toBe('Support Agent')
        ->instructions->toBe('Answer billing questions.')
        ->metadata->toBe(['team' => 'billing'])
        ->multiAgent->toBeInstanceOf(MultiAgent::class)
        ->reasoning->toBeInstanceOf(Reasoning::class)
        ->serviceTier->toBe('auto')
        ->text->toBeInstanceOf(Text::class)
        ->tools->toHaveCount(3);

    expect($result->tools[0]['type'])->toBe('function');
    expect($result->tools[1]['type'])->toBe('mcp');
    expect($result->tools[2]['type'])->toBe('web_search');
});

test('from with nullable fields', function () {
    $result = AgentResponse::from(agentListResource()['data'][1], meta());

    expect($result)
        ->name->toBeNull()
        ->instructions->toBeNull()
        ->metadata->toBe([])
        ->tools->toBe([]);

    expect($result->multiAgent->maxConcurrentSubagents)->toBeNull();
    expect($result->reasoning->effort)->toBeNull();
    expect($result->text->format)->toBe(['type' => 'json_schema', 'schema' => ['type' => 'object']]);
});

test('as array accessible', function () {
    $result = AgentResponse::from(agentResource(), meta());

    expect($result['name'])
        ->toBe('Support Agent');
});

test('to array', function () {
    $result = AgentResponse::from(agentResource(), meta());

    expect($result->toArray())
        ->toBe(agentResource());
});

test('fake', function () {
    $response = AgentResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentResponse::class)
        ->object->toBe('agent');
});
