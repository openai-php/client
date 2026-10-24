<?php

/**
 * @return array<string, mixed>
 */
function agentEnvironmentFileResource(): array
{
    return [
        'object' => 'agent.environment.file',
        'environment_id' => 'env_abc123',
        'path' => '/workspace/hello.txt',
        'size_bytes' => 6,
    ];
}

/**
 * @return array<string, mixed>
 */
function agentEnvironmentFileListResource(): array
{
    return [
        'object' => 'page',
        'data' => [
            agentEnvironmentFileResource(),
            [
                'object' => 'agent.environment.file',
                'environment_id' => 'env_abc123',
                'path' => '/workspace/report.csv',
                'size_bytes' => 2048,
            ],
        ],
        'has_more' => true,
        'next' => 'cursor_abc123',
    ];
}
