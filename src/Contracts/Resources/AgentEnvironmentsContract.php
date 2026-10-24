<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Agents\Environments\AgentEnvironmentListResponse;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;

interface AgentEnvironmentsContract
{
    /**
     * Create an agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AgentEnvironmentResponse;

    /**
     * List the agent environments in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentEnvironmentListResponse;

    /**
     * Retrieve an agent environment by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/methods/retrieve
     */
    public function retrieve(string $id): AgentEnvironmentResponse;

    /**
     * Manage the files in a connected agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/files
     */
    public function files(): AgentEnvironmentFilesContract;

    /**
     * Manage reusable agent environment templates.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates
     */
    public function templates(): AgentEnvironmentTemplatesContract;
}
