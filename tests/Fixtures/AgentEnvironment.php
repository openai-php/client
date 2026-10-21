<?php

/**
 * @return array<string, mixed>
 */
function agentEnvironmentResource(): array
{
    return [
        'id' => 'env_abc123',
        'object' => 'agent.environment',
        'type' => 'openai_hosted',
        'status' => 'ready',
        'files' => [
            [
                'type' => 'file_id',
                'id' => 'file_ws_1',
                'file_id' => 'file-abc123',
                'path' => '/workspace/report.csv',
                'size_bytes' => 2048,
            ],
            [
                'type' => 'inline',
                'id' => 'file_ws_2',
                'path' => '/workspace/hello.txt',
                'size_bytes' => 6,
            ],
        ],
        'plugins' => [
            [
                'type' => 'inline',
                'name' => 'csv-tools',
                'description' => 'Read and summarise CSV files.',
            ],
        ],
        'skills' => [
            [
                'type' => 'skill_reference',
                'skill_id' => 'skill_abc123',
                'version' => '2',
                'name' => 'basic-math',
                'description' => 'Add or multiply numbers.',
            ],
            [
                'type' => 'inline',
                'name' => 'notes',
                'description' => 'Keep short working notes.',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function agentEnvironmentListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            agentEnvironmentResource(),
            [
                'id' => 'env_def456',
                'object' => 'agent.environment',
                'type' => 'openai_hosted',
                'status' => 'pending',
                'files' => [],
                'plugins' => [],
                'skills' => [],
            ],
        ],
        'first_id' => 'env_abc123',
        'last_id' => 'env_def456',
        'has_more' => false,
    ];
}
