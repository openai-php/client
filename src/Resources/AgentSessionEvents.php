<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AgentSessionEventsContract;
use OpenAI\ValueObjects\Transporter\Payload;

final class AgentSessionEvents implements AgentSessionEventsContract
{
    use Concerns\Transportable;

    /**
     * Send input events to an agent session, such as a user message, a function call result or a cancellation.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/subresources/events/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $sessionId, array $parameters): void
    {
        $payload = Payload::create("agents/sessions/$sessionId/events", $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        $this->transporter->requestContent($payload);
    }
}
