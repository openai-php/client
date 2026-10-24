<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments;

final class AgentEnvironmentListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            AgentEnvironmentResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'env_abc123',
        'last_id' => 'env_abc123',
        'has_more' => false,
    ];
}
