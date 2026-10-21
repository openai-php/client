<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateDeleteResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateListResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;

interface AgentEnvironmentTemplatesContract
{
    /**
     * Create an agent environment template.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters = []): AgentEnvironmentTemplateResponse;

    /**
     * List the agent environment templates in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentEnvironmentTemplateListResponse;

    /**
     * Retrieve an agent environment template by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/retrieve
     */
    public function retrieve(string $id): AgentEnvironmentTemplateResponse;

    /**
     * Update an agent environment template.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): AgentEnvironmentTemplateResponse;

    /**
     * Delete an agent environment template by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/delete
     */
    public function delete(string $id): AgentEnvironmentTemplateDeleteResponse;
}
