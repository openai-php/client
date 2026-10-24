<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments\Files;

final class AgentEnvironmentFileResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'agent.environment.file',
        'environment_id' => 'env_abc123',
        'path' => '/workspace/data.csv',
        'size_bytes' => 128,
    ];
}
