<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadListResponse;
use OpenAI\Responses\Threads\ThreadResponse;

interface ThreadsContract
{
    /**
     * Create a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/createThread
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): ThreadResponse;

    /**
     * Retrieves a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/getThread
     */
    public function retrieve(string $id): ThreadResponse;

    /**
     * Modifies a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/modifyThread
     *
     * @param array<string, mixed> $parameters
     */
    public function modify(string $id, array $parameters): ThreadResponse;

    /**
     * Delete an thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/deleteThread
     */
    public function delete(string $id): ThreadDeleteResponse;

    /**
     * Returns a list of threads.
     *
     * @see TBA - there is no documentation yet
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ThreadListResponse;

    /**
     * Manage messages attached to a thred.
     *
     * @see https://platform.openai.com/docs/api-reference/messages
     */
    public function messages(): ThreadsMessagesContract;
}
