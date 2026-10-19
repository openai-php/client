<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents;

final class AgentDeleteResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'agent_abc123',
        'object' => 'agent.deleted',
        'deleted' => true,
    ];
}
