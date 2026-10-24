<?php

use OpenAI\Responses\Agents\Sessions\AgentSessionDeleteResponse;

test('from', function () {
    $result = AgentSessionDeleteResponse::from(agentSessionDeleteResource(), meta());

    expect($result)
        ->id->toBe('sess_abc123')
        ->object->toBe('agent.session.deleted')
        ->deleted->toBeTrue();
});

test('as array accessible', function () {
    $result = AgentSessionDeleteResponse::from(agentSessionDeleteResource(), meta());

    expect($result['deleted'])
        ->toBeTrue();
});

test('to array', function () {
    $result = AgentSessionDeleteResponse::from(agentSessionDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(agentSessionDeleteResource());
});

test('fake', function () {
    $response = AgentSessionDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentSessionDeleteResponse::class)
        ->deleted->toBeTrue();
});
