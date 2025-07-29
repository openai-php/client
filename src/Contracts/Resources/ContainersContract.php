<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Containers\CreateContainer;
use OpenAI\Responses\Containers\DeleteContainer;
use OpenAI\Responses\Containers\ListContainers;
use OpenAI\Responses\Containers\RetrieveContainer;

interface ContainersContract
{
    /**
     * Creates a container for use with the Code Interpreter tool.
     *
     * @see https://platform.openai.com/docs/api-reference/containers/createContainers
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateContainer;

    /**
     * Retrieves a container with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/containers/retrieveContainer
     */
    public function retrieve(string $id): RetrieveContainer;

    /**
     * Delete a container with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/containers/deleteContainer
     */
    public function delete(string $id): DeleteContainer;

    /**
     * List containers
     *
     * @see https://platform.openai.com/docs/api-reference/containers/listContainers
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListContainers;
}
