<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AgentSessionEventsContract;
use OpenAI\Resources\AgentSessionEvents;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AgentSessionEventsTestResource implements AgentSessionEventsContract
{
    use Testable;

    public function resource(): string
    {
        return AgentSessionEvents::class;
    }

    public function create(string $sessionId, array $parameters): void
    {
        $this->record(__FUNCTION__, func_get_args());
    }
}
