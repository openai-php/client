<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\BatchesContract;
use OpenAI\Responses\Batches\BatchListResponse;
use OpenAI\Responses\Batches\BatchResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Batches implements BatchesContract
{
    use Concerns\Transportable;

    /**
     * Creates and executes a batch from an uploaded file of requests
     *
     * @see https://platform.openai.com/docs/api-reference/batch/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): BatchResponse
    {
        $payload = Payload::create('batches', $parameters);

        /** @var Response<array{id: string, object: string, endpoint: string, errors?: array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts?: array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return BatchResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a batch.
     * *
     * @see https://platform.openai.com/docs/api-reference/batch/retrieve
     */
    public function retrieve(string $id): BatchResponse
    {
        $payload = Payload::retrieve('batches', $id);

        /** @var Response<array{id: string, object: string, endpoint: string, errors?: array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts?: array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return BatchResponse::from($response->data(), $response->meta());
    }

    /**
     * Cancels an in-progress batch.
     * *
     * @see https://platform.openai.com/docs/api-reference/batch/cancel
     */
    public function cancel(string $id): BatchResponse
    {
        $payload = Payload::cancel('batches', $id);

        /** @var Response<array{id: string, object: string, endpoint: string, errors?: array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts?: array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return BatchResponse::from($response->data(), $response->meta());
    }

    /**
     * List your organization's batches.
     *
     * @see https://platform.openai.com/docs/api-reference/batch/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): BatchListResponse
    {
        $payload = Payload::list('batches', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, endpoint: string, errors?: array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts?: array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return BatchListResponse::from($response->data(), $response->meta());
    }
}
