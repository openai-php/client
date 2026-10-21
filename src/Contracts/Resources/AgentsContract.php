<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Agents\AgentDeleteResponse;
use OpenAI\Responses\Agents\AgentListResponse;
use OpenAI\Responses\Agents\AgentResponse;

interface AgentsContract
{
    /**
     * Create a reusable agent.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AgentResponse;

    /**
     * List the reusable agents in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentListResponse;

    /**
     * Retrieve a reusable agent by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/retrieve
     */
    public function retrieve(string $id): AgentResponse;

    /**
     * Update a reusable agent.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): AgentResponse;

    /**
     * Delete a reusable agent by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/methods/delete
     */
    public function delete(string $id): AgentDeleteResponse;

    /**
     * Manage the OpenAI-hosted environments that agents run in.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments
     */
    public function environments(): AgentEnvironmentsContract;

    /**
     * Run agents in managed sessions.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/sessions
     */
    public function sessions(): AgentSessionsContract;
}
