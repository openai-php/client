<?php

use OpenAI\Responses\Agents\AgentDeleteResponse;

test('from', function () {
    $result = AgentDeleteResponse::from(agentDeleteResource(), meta());

    expect($result)
        ->id->toBe('agent_abc123')
        ->object->toBe('agent.deleted')
        ->deleted->toBeTrue();
});

test('as array accessible', function () {
    $result = AgentDeleteResponse::from(agentDeleteResource(), meta());

    expect($result['deleted'])
        ->toBeTrue();
});

test('to array', function () {
    $result = AgentDeleteResponse::from(agentDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(agentDeleteResource());
});

test('fake', function () {
    $response = AgentDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentDeleteResponse::class)
        ->deleted->toBeTrue();
});
