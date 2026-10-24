<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments\Templates;

final class AgentEnvironmentTemplateResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'envtmpl_abc123',
        'object' => 'agent.environment.template',
        'created_at' => 1760000000,
        'updated_at' => 1760000000,
        'name' => 'Python data tools',
        'capability_directories' => [],
        'desktop' => [
            'enabled' => false,
        ],
        'network' => [
            'access' => 'disabled',
            'allowed_domains' => [],
        ],
        'packages' => [
            'npm' => [],
            'python' => [
                'pandas',
            ],
            'system' => [],
        ],
        'files' => [],
        'plugins' => [],
        'skills' => [],
    ];
}
