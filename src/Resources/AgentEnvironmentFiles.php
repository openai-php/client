<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentFilesContract;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileListResponse;
use OpenAI\Responses\Agents\Environments\Files\AgentEnvironmentFileResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type AgentEnvironmentFileType from AgentEnvironmentFileResponse
 * @phpstan-import-type AgentEnvironmentFileListType from AgentEnvironmentFileListResponse
 */
final class AgentEnvironmentFiles implements AgentEnvironmentFilesContract
{
    use Concerns\Transportable;

    /**
     * Write a file into a connected agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/files/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $environmentId, array $parameters): AgentEnvironmentFileResponse
    {
        $payload = Payload::create("agents/environments/$environmentId/files", $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentFileType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentFileResponse::from($response->data(), $response->meta());
    }

    /**
     * List the files in a connected agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/files/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $environmentId, array $parameters = []): AgentEnvironmentFileListResponse
    {
        $payload = Payload::list("agents/environments/$environmentId/files", $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentFileListType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentFileListResponse::from($response->data(), $response->meta());
    }
}
