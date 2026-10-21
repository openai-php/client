<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Sessions;

final class AgentSessionDeleteResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'sess_abc123',
        'object' => 'agent.session.deleted',
        'deleted' => true,
    ];
}
