<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;

interface AssistantsContract
{
    /**
     * Create an assistant with a model and instructions.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/object
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AssistantResponse;

    /**
     * Retrieves an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/getAssistant
     */
    public function retrieve(string $id): AssistantResponse;

    /**
     * Modifies an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/modifyAssistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): AssistantResponse;

    /**
     * Delete an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/deleteAssistant
     */
    public function delete(string $id): AssistantDeleteResponse;

    /**
     * Returns a list of assistants.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/listAssistants
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AssistantListResponse;

    /**
     * Manage files attached to an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants
     */
    public function files(): AssistantsFilesContract;
}
