<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ThreadsMessagesFilesContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileListResponse;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsMessagesFiles extends Resource implements ThreadsMessagesFilesContract
{
    /**
     * Retrieves a message file.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/getMessageFile
     */
    public function retrieve(string $threadId, string $messageId, string $fileId): ThreadMessageFileResponse
    {
        $payload = Payload::retrieve("threads/$threadId/messages/$messageId/files", $fileId);

        /** @var Response<array{id: string, object: string, created_at: int, message_id: string}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadMessageFileResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, message_id: string}>, first_id: ?string, last_id: ?string, has_more: bool}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadMessageFileListResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }
}
