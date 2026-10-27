<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentsContract;
use OpenAI\Contracts\Resources\AgentsContract;
use OpenAI\Contracts\Resources\AgentSessionsContract;
use OpenAI\Responses\Agents\AgentDeleteResponse;
use OpenAI\Responses\Agents\AgentListResponse;
use OpenAI\Responses\Agents\AgentResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type AgentType from AgentResponse
 * @phpstan-import-type AgentListType from AgentListResponse
 * @phpstan-import-type AgentDeleteType from AgentDeleteResponse
 */
final class Agents implements AgentsContract
{
    use Concerns\Transportable;

    /**
     * Create a reusable agent.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AgentResponse
    {
        $payload = Payload::create('agents', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentResponse::from($response->data(), $response->meta());
    }

    /**
     * List the reusable agents in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentListResponse
    {
        $payload = Payload::list('agents', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentListType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve a reusable agent by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/retrieve
     */
    public function retrieve(string $id): AgentResponse
    {
        $payload = Payload::retrieve('agents', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentResponse::from($response->data(), $response->meta());
    }

    /**
     * Update a reusable agent.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): AgentResponse
    {
        $payload = Payload::modify('agents', $id, $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a reusable agent by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/delete
     */
    public function delete(string $id): AgentDeleteResponse
    {
        $payload = Payload::delete('agents', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage the OpenAI-hosted environments that agents run in.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments
     */
    public function environments(): AgentEnvironmentsContract
    {
        return new AgentEnvironments($this->transporter);
    }

    /**
     * Run agents in managed sessions.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions
     */
    public function sessions(): AgentSessionsContract
    {
        return new AgentSessions($this->transporter);
    }
}
