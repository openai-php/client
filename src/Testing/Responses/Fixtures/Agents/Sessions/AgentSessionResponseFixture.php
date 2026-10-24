<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Sessions;

final class AgentSessionResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'sess_abc123',
        'object' => 'agent.session',
        'created_at' => 1792606459,
        'last_active_at' => 1792606461,
        'status' => 'idle',
        'error' => null,
        'metadata' => [],
        'vault_ids' => [],
        'agent' => [
            'id' => 'agent_abc123',
            'model' => 'gpt-5.4-mini',
            'name' => null,
            'instructions' => 'Keep every reply to one word.',
            'multi_agent' => [
                'enabled' => false,
                'max_concurrent_subagents' => null,
            ],
            'reasoning' => [
                'effort' => 'low',
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
        ],
        'environment' => [
            'type' => 'none',
        ],
        'required_actions' => [],
        'usage' => null,
    ];
}
