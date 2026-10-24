<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileListResponse;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;

interface AgentEnvironmentFilesContract
{
    /**
     * Write a file into a connected agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/files/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $environmentId, array $parameters): AgentEnvironmentFileResponse;

    /**
     * List the files in a connected agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/files/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $environmentId, array $parameters = []): AgentEnvironmentFileListResponse;
}
