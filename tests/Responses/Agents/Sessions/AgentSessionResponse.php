<?php

use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;
use OpenAI\Responses\Agents\Sessions\Objects\SessionAgent;
use OpenAI\Responses\Responses\CreateResponseUsage;

test('from', function () {
    $result = AgentSessionResponse::from(agentSessionResource(), meta());

    expect($result)
        ->id->toBe('sess_abc123')
        ->object->toBe('agent.session')
        ->createdAt->toBe(1792606459)
        ->lastActiveAt->toBe(1792606461)
        ->status->toBe('idle')
        ->error->toBeNull()
        ->metadata->toBe(['purpose' => 'support'])
        ->vaultIds->toBe([])
        ->agent->toBeInstanceOf(SessionAgent::class)
        ->environment->toBe(['type' => 'none'])
        ->requiredActions->toBe([])
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->usage)
        ->inputTokens->toBe(7372)
        ->outputTokens->toBe(5)
        ->totalTokens->toBe(7377);
});

test('from with a required action and no usage', function () {
    $result = AgentSessionResponse::from(agentSessionListResource()['data'][1], meta());

    expect($result)
        ->status->toBe('requires_action')
        ->vaultIds->toBe(['vault_abc123'])
        ->usage->toBeNull();

    expect($result->requiredActions[0])
        ->toBe(['type' => 'function_call', 'call_id' => 'call_abc123', 'name' => 'get_invoice', 'arguments' => '{"number":"INV-1"}', 'turn_id' => 'turn_abc123']);
});

test('as array accessible', function () {
    $result = AgentSessionResponse::from(agentSessionResource(), meta());

    expect($result['status'])
        ->toBe('idle');
});

test('to array', function () {
    $result = AgentSessionResponse::from(agentSessionResource(), meta());

    expect($result->toArray())
        ->toBe(agentSessionResource());
});

test('to array with no usage', function () {
    $attributes = agentSessionListResource()['data'][1];

    expect(AgentSessionResponse::from($attributes, meta())->toArray())
        ->toBe($attributes);
});

test('fake', function () {
    $response = AgentSessionResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentSessionResponse::class)
        ->object->toBe('agent.session');
});
