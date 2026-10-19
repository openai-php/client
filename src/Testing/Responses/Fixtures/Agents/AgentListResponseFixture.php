<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents;

final class AgentListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            AgentResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'agent_abc123',
        'last_id' => 'agent_abc123',
        'has_more' => false,
    ];
}
