<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\FineTuningContract;
use OpenAI\Responses\FineTuning\ListJobEventsResponse;
use OpenAI\Responses\FineTuning\ListJobsResponse;
use OpenAI\Responses\FineTuning\RetrieveJobResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class FineTuning implements FineTuningContract
{
    use Concerns\Transportable;

    /**
     * Creates a job that fine-tunes a specified model from a given dataset.
     *
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function createJob(array $parameters): RetrieveJobResponse
    {
        $payload = Payload::create('fine_tuning/jobs', $parameters);

        /** @var Response<array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveJobResponse::from($response->data(), $response->meta());
    }

    /**
     * List your organization's fine-tuning jobs.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/undefined
     *
     * @param  array<string, mixed>  $parameters
     */
    public function listJobs(array $parameters = []): ListJobsResponse
    {
        $payload = Payload::list('fine_tuning/jobs', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}>, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListJobsResponse::from($response->data(), $response->meta());
    }

    /**
     * Gets info about the fine-tune job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/retrieve
     */
    public function retrieveJob(string $jobId): RetrieveJobResponse
    {
        $payload = Payload::retrieve('fine_tuning/jobs', $jobId);

        /** @var Response<array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveJobResponse::from($response->data(), $response->meta());
    }

    /**
     * Immediately cancel a fine-tune job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/cancel
     */
    public function cancelJob(string $jobId): RetrieveJobResponse
    {
        $payload = Payload::cancel('fine_tuning/jobs', $jobId);

        /** @var Response<array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveJobResponse::from($response->data(), $response->meta());
    }

    /**
     * Get status updates for a fine-tuning job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/list-events
     *
     * @param  array<string, mixed>  $parameters
     */
    public function listJobEvents(string $jobId, array $parameters = []): ListJobEventsResponse
    {
        $payload = Payload::retrieve('fine_tuning/jobs', $jobId, '/events', $parameters);

        /** @var Response<array{object: string, data: array<int, array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}>, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListJobEventsResponse::from($response->data(), $response->meta());
    }
}
