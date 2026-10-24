<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments;

final class AgentEnvironmentResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'env_abc123',
        'object' => 'agent.environment',
        'type' => 'openai_hosted',
        'status' => 'ready',
        'files' => [],
        'plugins' => [],
        'skills' => [],
    ];
}
