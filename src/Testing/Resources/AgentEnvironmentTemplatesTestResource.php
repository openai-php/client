<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentTemplatesContract;
use OpenAI\Resources\AgentEnvironmentTemplates;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateDeleteResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateListResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AgentEnvironmentTemplatesTestResource implements AgentEnvironmentTemplatesContract
{
    use Testable;

    public function resource(): string
    {
        return AgentEnvironmentTemplates::class;
    }

    public function create(array $parameters = []): AgentEnvironmentTemplateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): AgentEnvironmentTemplateListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): AgentEnvironmentTemplateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function update(string $id, array $parameters): AgentEnvironmentTemplateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): AgentEnvironmentTemplateDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
