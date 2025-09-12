<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\StreamResponse;

interface ResponsesContract
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
     * Create a streamed response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse;

    /**
     * Retrieves a model response with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/retrieve
     */
    public function retrieve(string $id): RetrieveResponse;

    /**
     * Cancels a model response with the given ID. Must be marked as 'background' to be cancellable.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/cancel
     */
    public function cancel(string $id): RetrieveResponse;

    /**
     * Deletes a model response with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/delete
     */
    public function delete(string $id): DeleteResponse;

    /**
     * Returns a list of input items for a given response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/input-items
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $id, array $parameters = []): ListInputItems;

    /**
     * Manage conversations as a sub-resource of Responses namespace for convenience in tests.
     */
    public function conversations(): ConversationsContract;
}
