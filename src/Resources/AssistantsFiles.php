<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AssistantsContract;
use OpenAI\Contracts\Resources\AssistantsFilesContract;
use OpenAI\Contracts\Resources\ListAssistantsResponse;
use OpenAI\Responses\Assistant\AssistantDeleteResponse;
use OpenAI\Responses\Assistant\AssistantFileDeleteResponse;
use OpenAI\Responses\Assistant\AssistantFileListResponse;
use OpenAI\Responses\Assistant\AssistantFileResponse;
use OpenAI\Responses\Assistant\AssistantListResponse;
use OpenAI\Responses\Assistant\AssistantResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class AssistantsFiles implements AssistantsFilesContract
{
    use Concerns\Transportable;

    /**
     * Create an assistant file by attaching a File to an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/createAssistantFile
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $assistantId, array $parameters): AssistantFileResponse
    {
        $payload = Payload::create("assistants/$assistantId/files", $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantFileResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves an AssistantFile.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/getAssistantFile
     */
    public function retrieve(string $assistantId, string $fileId): AssistantFileResponse
    {
        $payload = Payload::retrieve("assistants/$assistantId/files", $fileId);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantFileResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an assistant file.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/deleteAssistantFile
     */
    public function delete(string $assistantId, string $fileId): AssistantFileDeleteResponse
    {
        $payload = Payload::delete("assistants/$assistantId/files", $fileId);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantFileDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of assistant files.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/listAssistantFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $assistantId, array $parameters = []): AssistantFileListResponse
    {
        $payload = Payload::list("assistants/$assistantId/files", $parameters);

        /** @var Response<array{data: array<int, array{id: string, object: string, created: int, data: array<int, array{url?: string, b64_json?: string}>}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantFileListResponse::from($response->data(), $response->meta());
    }
}
