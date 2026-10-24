<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AgentSessionEventsContract;
use OpenAI\Contracts\Resources\AgentSessionsContract;
use OpenAI\Resources\AgentSessions;
use OpenAI\Responses\Agents\Sessions\AgentSessionDeleteResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionListResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AgentSessionsTestResource implements AgentSessionsContract
{
    use Testable;

    public function resource(): string
    {
        return AgentSessions::class;
    }

    public function create(array $parameters): AgentSessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): AgentSessionListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): AgentSessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function update(string $id, array $parameters): AgentSessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): AgentSessionDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function events(): AgentSessionEventsContract
    {
        return new AgentSessionEventsTestResource($this->fake);
    }
}
