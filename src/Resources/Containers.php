<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ContainersContract;
use OpenAI\Responses\Containers\CreateContainer;
use OpenAI\Responses\Containers\DeleteContainer;
use OpenAI\Responses\Containers\ListContainers;
use OpenAI\Responses\Containers\RetrieveContainer;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type CreateContainerType from CreateContainer
 * @phpstan-import-type RetrieveContainerType from RetrieveContainer
 * @phpstan-import-type DeleteContainerType from DeleteContainer
 * @phpstan-import-type ListContainersType from ListContainers
 */
final class Containers implements ContainersContract
{
    use Concerns\Transportable;

    /**
     * Creates a container for use with the Code Interpreter tool.
     *
     * @see https://platform.openai.com/docs/api-reference/containers/createContainers
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateContainer
    {
        $payload = Payload::create('containers', $parameters);

        /** @var Response<CreateContainerType> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateContainer::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a container with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/containers/retrieveContainer
     */
    public function retrieve(string $id): RetrieveContainer
    {
        $payload = Payload::retrieve('containers', $id);

        /** @var Response<RetrieveContainerType> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveContainer::from($response->data(), $response->meta());
    }

    /**
     * Delete a container with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/containers/deleteContainer
     */
    public function delete(string $id): DeleteContainer
    {
        $payload = Payload::delete('containers', $id);

        /** @var Response<DeleteContainerType> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteContainer::from($response->data(), $response->meta());
    }

    /**
     * List containers
     *
     * @see https://platform.openai.com/docs/api-reference/containers/listContainers
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListContainers
    {
        $payload = Payload::list('containers', $parameters);

        /** @var Response<ListContainersType> $response */
        $response = $this->transporter->requestObject($payload);

        return ListContainers::from($response->data(), $response->meta());
    }
}
