<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentFilesContract;
use OpenAI\Resources\AgentEnvironmentFiles;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileListResponse;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AgentEnvironmentFilesTestResource implements AgentEnvironmentFilesContract
{
    use Testable;

    public function resource(): string
    {
        return AgentEnvironmentFiles::class;
    }

    public function create(string $environmentId, array $parameters): AgentEnvironmentFileResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $environmentId, array $parameters = []): AgentEnvironmentFileListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
