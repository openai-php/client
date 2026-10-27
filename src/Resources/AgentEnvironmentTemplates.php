<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AgentEnvironmentTemplatesContract;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateDeleteResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateListResponse;
use OpenAI\Responses\Agents\Environments\Templates\AgentEnvironmentTemplateResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type AgentEnvironmentTemplateType from AgentEnvironmentTemplateResponse
 * @phpstan-import-type AgentEnvironmentTemplateListType from AgentEnvironmentTemplateListResponse
 * @phpstan-import-type AgentEnvironmentTemplateDeleteType from AgentEnvironmentTemplateDeleteResponse
 */
final class AgentEnvironmentTemplates implements AgentEnvironmentTemplatesContract
{
    use Concerns\Transportable;

    /**
     * Create an agent environment template.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters = []): AgentEnvironmentTemplateResponse
    {
        $payload = Payload::create('agents/environments/templates', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentTemplateType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentTemplateResponse::from($response->data(), $response->meta());
    }

    /**
     * List the agent environment templates in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AgentEnvironmentTemplateListResponse
    {
        $payload = Payload::list('agents/environments/templates', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentTemplateListType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentTemplateListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve an agent environment template by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/retrieve
     */
    public function retrieve(string $id): AgentEnvironmentTemplateResponse
    {
        $payload = Payload::retrieve('agents/environments/templates', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentTemplateType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentTemplateResponse::from($response->data(), $response->meta());
    }

    /**
     * Update an agent environment template.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): AgentEnvironmentTemplateResponse
    {
        $payload = Payload::modify('agents/environments/templates', $id, $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentTemplateType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentTemplateResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an agent environment template by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/environments/subresources/templates/methods/delete
     */
    public function delete(string $id): AgentEnvironmentTemplateDeleteResponse
    {
        $payload = Payload::delete('agents/environments/templates', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<AgentEnvironmentTemplateDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return AgentEnvironmentTemplateDeleteResponse::from($response->data(), $response->meta());
    }
}
