<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Agents\Sessions\AgentSessionDeleteResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionListResponse;
use OpenAI\Responses\Agents\Sessions\AgentSessionResponse;

interface AgentSessionsContract
{
    /**
     * Create an agent session.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AgentSessionResponse;

    /**
     * List the agent sessions in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentSessionListResponse;

    /**
     * Retrieve an agent session by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/retrieve
     */
    public function retrieve(string $id): AgentSessionResponse;

    /**
     * Update an agent session.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): AgentSessionResponse;

    /**
     * Delete an agent session by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/methods/delete
     */
    public function delete(string $id): AgentSessionDeleteResponse;

    /**
     * Send input events to an agent session.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions/subresources/events
     */
    public function events(): AgentSessionEventsContract;
}
