<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Assistant\AssistantListResponse;
use OpenAI\Responses\Assistant\AssistantResponse;
use OpenAI\Responses\Assistant\AssistantDeleteResponse;
use OpenAI\Responses\Files\RetrieveResponse;
use OpenAI\Responses\FineTuning\ListJobsResponse;
use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\VariationResponse;

interface AssistantContract
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
     * @param array<string, mixed> $parameters
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
}
