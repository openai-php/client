<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ThreadsContract;
use OpenAI\Contracts\Resources\ThreadsMessagesContract;
use OpenAI\Contracts\Resources\ThreadsRunsContract;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadListResponse;
use OpenAI\Responses\Threads\ThreadResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Threads implements ThreadsContract
{
    use Concerns\Transportable;

    /**
     * Create a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/createThread
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): ThreadResponse
    {
        $payload = Payload::create('threads', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadResponse::from($response->data(), $response->meta());
    }

    /**
     * Create a thread and run it in one request.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/createThreadAndRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function createAndRun(array $parameters): ThreadRunResponse
    {
        $payload = Payload::create('threads/runs', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/getThread
     */
    public function retrieve(string $id): ThreadResponse
    {
        $payload = Payload::retrieve('threads', $id);

        /** @var Response<array{id: string, object: string, created_at: int, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/modifyThread
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): ThreadResponse
    {
        $payload = Payload::modify('threads', $id, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an thread.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/deleteThread
     */
    public function delete(string $id): ThreadDeleteResponse
    {
        $payload = Payload::delete('threads', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of assistants.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/listAssistants
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ThreadListResponse
    {
        $payload = Payload::list('threads', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadListResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage messages attached to a thred.
     *
     * @see https://platform.openai.com/docs/api-reference/messages
     */
    public function messages(): ThreadsMessagesContract
    {
        return new ThreadsMessages($this->transporter);
    }

    /**
     * Represents an execution run on a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/runs
     */
    public function runs(): ThreadsRunsContract
    {
        return new ThreadsRuns($this->transporter);
    }
}
