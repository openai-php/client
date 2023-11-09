<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ListAssistantsResponse;
use OpenAI\Contracts\Resources\ThreadsContract;
use OpenAI\Contracts\Resources\ThreadsMessagesContract;
use OpenAI\Contracts\Resources\ThreadsMessagesFilesContract;
use OpenAI\Responses\Threads\Messages\ThreadMessageDeleteResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadListResponse;
use OpenAI\Responses\Threads\ThreadResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsMessages implements ThreadsMessagesContract
{
    use Concerns\Transportable;

    /**
     * Create a message.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/createMessage
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $threadId, array $parameters): ThreadMessageResponse
    {
        $payload = Payload::create("threads/$threadId/messages", $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve a message.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/getMessage
     */
    public function retrieve(string $threadId, string $messageId): ThreadMessageResponse
    {
        $payload = Payload::retrieve("threads/$threadId/messages", $messageId);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies a message.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/modifyMessage
     *
     * @param array<string, mixed> $parameters
     */
    public function modify(string $threadId, string $messageId, array $parameters): ThreadMessageResponse
    {
        $payload = Payload::modify("threads/$threadId/messages", $messageId, $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an message.
     *
     * @see TBD - there is no documentation yet
     */
    public function delete(string $threadId, string $messageId): ThreadMessageDeleteResponse
    {
        $payload = Payload::delete("threads/$threadId/messages", $messageId);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of messages for a given thread.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/listMessages
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, array $parameters = []): ThreadMessageListResponse
    {
        $payload = Payload::list("threads/$threadId/messages", $parameters);

        /** @var Response<array{data: array<int, array{id: string, object: string, created: int, data: array<int, array{url?: string, b64_json?: string}>}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageListResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage files attached to a thred message.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/file-object
     */
    public function files(): ThreadsMessagesFilesContract
    {
        return new ThreadsMessagesFiles($this->transporter);
    }
}
