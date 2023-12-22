<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ThreadsMessagesContract;
use OpenAI\Contracts\Resources\ThreadsMessagesFilesContract;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
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

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_file', image_file: array{file_id: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}> $response */
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

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_file', image_file: array{file_id: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies a message.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/modifyMessage
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $threadId, string $messageId, array $parameters): ThreadMessageResponse
    {
        $payload = Payload::modify("threads/$threadId/messages", $messageId, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_file', image_file: array{file_id: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
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

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_file', image_file: array{file_id: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageListResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage files attached to a thread message.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/file-object
     */
    public function files(): ThreadsMessagesFilesContract
    {
        return new ThreadsMessagesFiles($this->transporter);
    }
}
