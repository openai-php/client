<?php

/**
 * @return array<string, mixed>
 */
function agentResource(): array
{
    return [
        'id' => 'agent_abc123',
        'object' => 'agent',
        'created_at' => 1760000000,
        'updated_at' => 1760000100,
        'model' => 'gpt-5.4',
        'name' => 'Support Agent',
        'instructions' => 'Answer billing questions.',
        'metadata' => [
            'team' => 'billing',
        ],
        'multi_agent' => [
            'enabled' => true,
            'max_concurrent_subagents' => 6,
        ],
        'reasoning' => [
            'effort' => 'medium',
            'summary' => 'auto',
        ],
        'service_tier' => 'auto',
        'text' => [
            'format' => [
                'type' => 'text',
            ],
            'verbosity' => 'medium',
        ],
        'tools' => [
            [
                'type' => 'function',
                'name' => 'get_invoice',
                'description' => 'Look up an invoice by its number.',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'number' => ['type' => 'string'],
                    ],
                    'required' => ['number'],
                ],
                'defer_loading' => false,
            ],
            [
                'type' => 'mcp',
                'server_label' => 'docs',
                'transport' => [
                    'type' => 'http',
                    'server_url' => 'https://example.com/mcp',
                    'headers' => [],
                ],
                'allowed_tools' => null,
                'connection_origin' => 'service',
                'credential_id' => null,
                'request_metadata' => [],
                'required' => false,
            ],
            [
                'type' => 'web_search',
                'allowed_domains' => null,
                'context_size' => 'medium',
                'location' => null,
                'mode' => 'live',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function agentListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            agentResource(),
            [
                'id' => 'agent_def456',
                'object' => 'agent',
                'created_at' => 1760000200,
                'updated_at' => 1760000200,
                'model' => 'gpt-5.4-mini',
                'name' => null,
                'instructions' => null,
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
                        'type' => 'json_schema',
                        'schema' => [
                            'type' => 'object',
                        ],
                    ],
                    'verbosity' => 'low',
                ],
                'tools' => [],
            ],
        ],
        'first_id' => 'agent_abc123',
        'last_id' => 'agent_def456',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function agentDeleteResource(): array
{
    return [
        'id' => 'agent_abc123',
        'object' => 'agent.deleted',
        'deleted' => true,
    ];
}
