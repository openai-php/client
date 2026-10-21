<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentsContract;
use OpenAI\Contracts\Resources\AgentsContract;
use OpenAI\Contracts\Resources\AgentSessionsContract;
use OpenAI\Resources\Agents;
use OpenAI\Responses\Agents\AgentDeleteResponse;
use OpenAI\Responses\Agents\AgentListResponse;
use OpenAI\Responses\Agents\AgentResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AgentsTestResource implements AgentsContract
{
    use Testable;

    public function resource(): string
    {
        return Agents::class;
    }

    public function create(array $parameters): AgentResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): AgentListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): AgentResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function update(string $id, array $parameters): AgentResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): AgentDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function environments(): AgentEnvironmentsContract
    {
        return new AgentEnvironmentsTestResource($this->fake);
    }

    public function sessions(): AgentSessionsContract
    {
        return new AgentSessionsTestResource($this->fake);
    }
}
