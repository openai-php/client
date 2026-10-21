<?php

use OpenAI\Responses\Agents\Objects\MultiAgent;
use OpenAI\Responses\Agents\Objects\Reasoning;
use OpenAI\Responses\Agents\Objects\Text;
use OpenAI\Responses\Agents\Sessions\Objects\SessionAgent;

test('from', function () {
    $result = SessionAgent::from(agentSessionResource()['agent']);

    expect($result)
        ->id->toBe('agent_abc123')
        ->model->toBe('gpt-5.4-mini')
        ->name->toBeNull()
        ->instructions->toBe('Keep every reply to one word.')
        ->multiAgent->toBeInstanceOf(MultiAgent::class)
        ->reasoning->toBeInstanceOf(Reasoning::class)
        ->serviceTier->toBe('auto')
        ->text->toBeInstanceOf(Text::class)
        ->tools->toBe([]);

    expect($result->reasoning->effort)->toBe('low');
});

test('to array', function () {
    $attributes = agentSessionResource()['agent'];

    expect(SessionAgent::from($attributes)->toArray())
        ->toBe($attributes);
});
