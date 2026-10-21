<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AgentSessionsContract;
use OpenAI\Responses\Agents\Sessions\AgentSessionDeleteResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionListResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type AgentSessionType from AgentSessionResponse
 * @phpstan-import-type AgentSessionListType from AgentSessionListResponse
 * @phpstan-import-type AgentSessionDeleteType from AgentSessionDeleteResponse
 */
final class AgentSessions implements AgentSessionsContract
{
    use Concerns\Transportable;

    /**
     * Create an agent session.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AgentSessionResponse
    {
        $payload = Payload::create('agents/sessions', $parameters);

        /** @var Response<AgentSessionType> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'agents=v1')
            ->requestObject($payload);

        return AgentSessionResponse::from($response->data(), $response->meta());
    }

    /**
     * List the agent sessions in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentSessionListResponse
    {
        $payload = Payload::list('agents/sessions', $parameters);

        /** @var Response<AgentSessionListType> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'agents=v1')
            ->requestObject($payload);

        return AgentSessionListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve an agent session by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/retrieve
     */
    public function retrieve(string $id): AgentSessionResponse
    {
        $payload = Payload::retrieve('agents/sessions', $id);

        /** @var Response<AgentSessionType> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'agents=v1')
            ->requestObject($payload);

        return AgentSessionResponse::from($response->data(), $response->meta());
    }

    /**
     * Update an agent session.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): AgentSessionResponse
    {
        $payload = Payload::modify('agents/sessions', $id, $parameters);

        /** @var Response<AgentSessionType> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'agents=v1')
            ->requestObject($payload);

        return AgentSessionResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an agent session by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/delete
     */
    public function delete(string $id): AgentSessionDeleteResponse
    {
        $payload = Payload::delete('agents/sessions', $id);

        /** @var Response<AgentSessionDeleteType> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'agents=v1')
            ->requestObject($payload);

        return AgentSessionDeleteResponse::from($response->data(), $response->meta());
    }
}
