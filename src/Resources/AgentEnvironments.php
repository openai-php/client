<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentFilesContract;
use OpenAI\Contracts\Resources\AgentEnvironmentsContract;
use OpenAI\Contracts\Resources\AgentEnvironmentTemplatesContract;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentListResponse;
use OpenAI\Responses\Agents\Environments\AgentEnvironmentResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type AgentEnvironmentType from AgentEnvironmentResponse
 * @phpstan-import-type AgentEnvironmentListType from AgentEnvironmentListResponse
 */
final class AgentEnvironments implements AgentEnvironmentsContract
{
    use Concerns\Transportable;

    /**
     * Create an agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AgentEnvironmentResponse
    {
        $payload = Payload::create('agents/environments', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentResponse::from($response->data(), $response->meta());
    }

    /**
     * List the agent environments in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentEnvironmentListResponse
    {
        $payload = Payload::list('agents/environments', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentListType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve an agent environment by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/methods/retrieve
     */
    public function retrieve(string $id): AgentEnvironmentResponse
    {
        $payload = Payload::retrieve('agents/environments', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage the files in a connected agent environment.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/files
     */
    public function files(): AgentEnvironmentFilesContract
    {
        return new AgentEnvironmentFiles($this->transporter);
    }

    /**
     * Manage reusable agent environment templates.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates
     */
    public function templates(): AgentEnvironmentTemplatesContract
    {
        return new AgentEnvironmentTemplates($this->transporter);
    }
}
