<?php

/**
 * @return array<string, mixed>
 */
function agentEnvironmentTemplateResource(): array
{
    return [
        'id' => 'envtmpl_abc123',
        'object' => 'agent.environment.template',
        'created_at' => 1792600518,
        'updated_at' => 1792600520,
        'name' => 'Python data tools',
        'capability_directories' => [
            '/workspace/capabilities',
        ],
        'desktop' => [
            'enabled' => false,
        ],
        'network' => [
            'access' => 'restricted',
            'allowed_domains' => [
                'pypi.org',
                'files.pythonhosted.org',
            ],
        ],
        'packages' => [
            'npm' => [],
            'python' => [
                'requests',
            ],
            'system' => [],
        ],
        'files' => [
            [
                'type' => 'inline',
                'path' => '/workspace/hello.txt',
                'size_bytes' => 6,
            ],
            [
                'type' => 'file_id',
                'file_id' => 'file-abc123',
                'path' => '/workspace/report.csv',
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
                'version' => null,
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
function agentEnvironmentTemplateListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            agentEnvironmentTemplateResource(),
            [
                'id' => 'envtmpl_def456',
                'object' => 'agent.environment.template',
                'created_at' => 1792600600,
                'updated_at' => 1792600600,
                'name' => null,
                'capability_directories' => [],
                'desktop' => [
                    'enabled' => false,
                ],
                'network' => [
                    'access' => 'enabled',
                    'allowed_domains' => [],
                ],
                'packages' => [
                    'npm' => [],
                    'python' => [],
                    'system' => [],
                ],
                'files' => [],
                'plugins' => [],
                'skills' => [],
            ],
        ],
        'first_id' => 'envtmpl_abc123',
        'last_id' => 'envtmpl_def456',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function agentEnvironmentTemplateDeleteResource(): array
{
    return [
        'id' => 'envtmpl_abc123',
        'object' => 'agent.environment.template.deleted',
        'deleted' => true,
    ];
}
