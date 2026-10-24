<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

interface AgentSessionEventsContract
{
    /**
     * Send input events to an agent session, such as a user message, a function call result or a cancellation.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/subresources/events/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $sessionId, array $parameters): void;
}
