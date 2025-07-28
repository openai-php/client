<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Containers\DeleteContainer;
use OpenAI\Responses\Containers\RetrieveContainer;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\ListInputItems;

interface ContainersContract
{
    /**
     * Creates a model response.
     * Provide text or image inputs to generate text or JSON outputs.
     * Have the model call your own custom code or use built-in tools
     * like web search or file search to use your own data as input for the model's response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;

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
     * Returns a list of input items for a given response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/input-items
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $id, array $parameters = []): ListInputItems;
}
