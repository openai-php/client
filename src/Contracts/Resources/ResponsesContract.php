<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\ListInputItems;

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
     * 
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse;

    /**
     * Retrieve a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/retrieve
     */
    public function retrieve(string $id): RetrieveResponse;

    /**
     * Delete a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/delete
     */
    public function delete(string $id): DeleteResponse;

    /**
     * List input items for a response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/input-items
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $id, array $parameters = []): ListInputItems;
}
