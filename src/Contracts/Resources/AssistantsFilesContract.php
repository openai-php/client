<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Assistants\Files\AssistantFileDeleteResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileListResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileResponse;

interface AssistantsFilesContract
{
    /**
     * Create an assistant file by attaching a File to an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/createAssistantFile
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $assistantId, array $parameters): AssistantFileResponse;

    /**
     * Retrieves an AssistantFile.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/getAssistantFile
     */
    public function retrieve(string $assistantId, string $fileId): AssistantFileResponse;

    /**
     * Delete an assistant file.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/deleteAssistantFile
     */
    public function delete(string $assistantId, string $fileId): AssistantFileDeleteResponse;

    /**
     * Returns a list of assistant files.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/listAssistantFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $assistantId, array $parameters = []): AssistantFileListResponse;
}
