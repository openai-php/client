<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents;

final class AgentResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'agent_abc123',
        'object' => 'agent',
        'created_at' => 1760000000,
        'updated_at' => 1760000000,
        'model' => 'gpt-5.4',
        'name' => 'Support Agent',
        'instructions' => 'Answer billing questions.',
        'metadata' => [],
        'multi_agent' => [
            'enabled' => false,
            'max_concurrent_subagents' => null,
        ],
        'reasoning' => [
            'effort' => null,
            'summary' => null,
        ],
        'service_tier' => 'auto',
        'text' => [
            'format' => [
                'type' => 'text',
            ],
            'verbosity' => 'medium',
        ],
        'tools' => [],
    ];
}
