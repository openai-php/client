<?php

namespace OpenAI\Testing\Responses\Fixtures\Agents\Environments\Templates;

final class AgentEnvironmentTemplateDeleteResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'envtmpl_abc123',
        'object' => 'agent.environment.template.deleted',
        'deleted' => true,
    ];
}
