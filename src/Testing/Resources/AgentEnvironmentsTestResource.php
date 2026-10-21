<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentFilesContract;
use OpenAI\Contracts\Resources\AgentEnvironmentsContract;
use OpenAI\Contracts\Resources\AgentEnvironmentTemplatesContract;
use OpenAI\Resources\AgentEnvironments;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentListResponse;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AgentEnvironmentsTestResource implements AgentEnvironmentsContract
{
    use Testable;

    public function resource(): string
    {
        return AgentEnvironments::class;
    }

    public function create(array $parameters): AgentEnvironmentResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): AgentEnvironmentListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): AgentEnvironmentResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function files(): AgentEnvironmentFilesContract
    {
        return new AgentEnvironmentFilesTestResource($this->fake);
    }

    public function templates(): AgentEnvironmentTemplatesContract
    {
        return new AgentEnvironmentTemplatesTestResource($this->fake);
    }
}
