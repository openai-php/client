<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Sessions;

final class AgentSessionListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            AgentSessionResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'sess_abc123',
        'last_id' => 'sess_abc123',
        'has_more' => false,
    ];
}
