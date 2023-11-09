<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ListAssistantsResponse;
use OpenAI\Contracts\Resources\ThreadsMessagesContract;
use OpenAI\Contracts\Resources\ThreadsMessagesFilesContract;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileListResponse;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageDeleteResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsMessagesFiles implements ThreadsMessagesFilesContract
{
    use Concerns\Transportable;

    /**
     * Retrieves a message file.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/getMessageFile
     */
    public function retrieve(string $threadId, string $messageId, string $fileId): ThreadMessageFileResponse
    {
        $payload = Payload::retrieve("threads/$threadId/messages/$messageId/files", $fileId);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageFileResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of message files.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/listMessageFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, string $messageId, array $parameters = []): ThreadMessageFileListResponse
    {
        $payload = Payload::list("threads/$threadId/messages/$messageId/files", $parameters);

        /** @var Response<array{data: array<int, array{id: string, object: string, created: int, data: array<int, array{url?: string, b64_json?: string}>}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageFileListResponse::from($response->data(), $response->meta());
    }
}
