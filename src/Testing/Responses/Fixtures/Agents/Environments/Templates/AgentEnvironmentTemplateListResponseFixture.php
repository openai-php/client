<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments\Templates;

final class AgentEnvironmentTemplateListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            AgentEnvironmentTemplateResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'envtmpl_abc123',
        'last_id' => 'envtmpl_abc123',
        'has_more' => false,
    ];
}
