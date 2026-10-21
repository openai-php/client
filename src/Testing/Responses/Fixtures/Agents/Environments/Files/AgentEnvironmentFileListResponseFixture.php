<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments\Files;

final class AgentEnvironmentFileListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'page',
        'data' => [
            AgentEnvironmentFileResponseFixture::ATTRIBUTES,
        ],
        'has_more' => false,
        'next' => null,
    ];
}
