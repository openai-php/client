<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\Responses\ListResponse;
use OpenAI\Responses\Responses\ListInputItemsResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Contracts\StringableContract;

/**
 * @internal
 */
interface ResponsesContract
{
    /**
     * Create a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     */
    public function create(array $parameters): CreateResponse;

    /**
     * Create a streamed response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     */
    public function createStreamed(array $parameters): CreateStreamedResponse;

    /**
     * Retrieve a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/retrieve
     */
    public function retrieve(string $responseId): RetrieveResponse;

    /**
     * Delete a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/delete
     */
    public function delete(string $responseId): DeleteResponse;

    /**
     * Lists the input items for a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/input-items
     */
    public function listInputItems(string $responseId, array $parameters): ListInputItemsResponse;

    /**
     * Returns a list of responses.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/list
     */
    public function list(array $parameters): ListResponse;
}