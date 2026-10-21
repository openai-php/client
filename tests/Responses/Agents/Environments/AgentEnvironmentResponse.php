<?php

use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;

test('from', function () {
    $result = AgentEnvironmentResponse::from(agentEnvironmentResource(), meta());

    expect($result)
        ->id->toBe('env_abc123')
        ->object->toBe('agent.environment')
        ->type->toBe('openai_hosted')
        ->status->toBe('ready')
        ->files->toHaveCount(2)
        ->plugins->toHaveCount(1)
        ->skills->toHaveCount(2);
});

test('from with each file and skill type', function () {
    $result = AgentEnvironmentResponse::from(agentEnvironmentResource(), meta());

    expect($result->files[0]['type'])->toBe('file_id');
    expect($result->files[1]['type'])->toBe('inline');
    expect($result->skills[0])->toBe(['type' => 'skill_reference', 'skill_id' => 'skill_abc123', 'version' => '2', 'name' => 'basic-math', 'description' => 'Add or multiply numbers.']);
    expect($result->skills[1]['type'])->toBe('inline');
});

test('as array accessible', function () {
    $result = AgentEnvironmentResponse::from(agentEnvironmentResource(), meta());

    expect($result['status'])
        ->toBe('ready');
});

test('to array', function () {
    $result = AgentEnvironmentResponse::from(agentEnvironmentResource(), meta());

    expect($result->toArray())
        ->toBe(agentEnvironmentResource());
});

test('fake', function () {
    $response = AgentEnvironmentResponse::fake();

    expect($response)
        ->toBeInstanceOf(AgentEnvironmentResponse::class)
        ->object->toBe('agent.environment');
});
