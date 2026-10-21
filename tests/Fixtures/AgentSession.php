<?php

/**
 * @return array<string, mixed>
 */
function agentSessionResource(): array
{
    return [
        'id' => 'sess_abc123',
        'object' => 'agent.session',
        'created_at' => 1792606459,
        'last_active_at' => 1792606461,
        'status' => 'idle',
        'error' => null,
        'metadata' => [
            'purpose' => 'support',
        ],
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
        'usage' => [
            'input_tokens' => 7372,
            'input_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'output_tokens' => 5,
            'output_tokens_details' => [
                'reasoning_tokens' => 0,
            ],
            'total_tokens' => 7377,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function agentSessionListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            agentSessionResource(),
            [
                'id' => 'sess_def456',
                'object' => 'agent.session',
                'created_at' => 1792606500,
                'last_active_at' => 1792606500,
                'status' => 'requires_action',
                'error' => null,
                'metadata' => [],
                'vault_ids' => [
                    'vault_abc123',
                ],
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
                'required_actions' => [
                    [
                        'type' => 'function_call',
                        'call_id' => 'call_abc123',
                        'name' => 'get_invoice',
                        'arguments' => '{"number":"INV-1"}',
                        'turn_id' => 'turn_abc123',
                    ],
                ],
                'usage' => null,
            ],
        ],
        'first_id' => 'sess_abc123',
        'last_id' => 'sess_def456',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function agentSessionDeleteResource(): array
{
    return [
        'id' => 'sess_abc123',
        'object' => 'agent.session.deleted',
        'deleted' => true,
    ];
}
