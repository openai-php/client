<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\DeleteResponse;
use OpenAI\Responses\Chat\ListResponse;
use OpenAI\Responses\StreamResponse;

interface ChatContract
{
    /**
     * Creates a completion for the chat message
     *
     * @see https://platform.openai.com/docs/api-reference/chat/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * Creates a streamed completion for the chat message
     *
     * @see https://platform.openai.com/docs/api-reference/chat/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse;

    /**
     * Lists the stored chat completions, the ones created with `store` set to `true`
     *
     * @see https://platform.openai.com/docs/api-reference/chat/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * Retrieves a stored chat completion
     *
     * @see https://platform.openai.com/docs/api-reference/chat/get
     */
    public function retrieve(string $completionId): CreateResponse;

    /**
     * Updates the metadata of a stored chat completion
     *
     * @see https://platform.openai.com/docs/api-reference/chat/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $completionId, array $parameters): CreateResponse;

    /**
     * Deletes a stored chat completion
     *
     * @see https://platform.openai.com/docs/api-reference/chat/delete
     */
    public function delete(string $completionId): DeleteResponse;
}
