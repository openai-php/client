<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\FineTunesContract;
use OpenAI\Responses\FineTunes\ListEventsResponse;
use OpenAI\Responses\FineTunes\ListResponse;
use OpenAI\Responses\FineTunes\RetrieveResponse;
use OpenAI\Responses\FineTunes\RetrieveStreamedResponseEvent;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class FineTunes implements FineTunesContract
{
    use Concerns\Transportable;

    /**
     * Creates a job that fine-tunes a specified model from a given dataset.
     *
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): RetrieveResponse
    {
        $payload = Payload::create('fine-tunes', $parameters);

        /** @var Response<array{id: string, object: string, model: string, created_at: int, events: array<int, array{object: string, created_at: int, level: string, message: string}>, fine_tuned_model: ?string, hyperparams: array{batch_size: ?int, learning_rate_multiplier: ?float, n_epochs: int, prompt_loss_weight: float}, organization_id: string, result_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, status: string, validation_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, training_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, updated_at: int}>  $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data(), $response->meta());
    }

    /**
     * List your organization's fine-tuning jobs.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/list
     */
    public function list(): ListResponse
    {
        $payload = Payload::list('fine-tunes');

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, model: string, created_at: int, events: array<int, array{object: string, created_at: int, level: string, message: string}>, fine_tuned_model: ?string, hyperparams: array{batch_size: ?int, learning_rate_multiplier: ?float, n_epochs: int, prompt_loss_weight: float}, organization_id: string, result_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, status: string, validation_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, training_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, updated_at: int}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data(), $response->meta());
    }

    /**
     * Gets info about the fine-tune job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/list
     */
    public function retrieve(string $fineTuneId): RetrieveResponse
    {
        $payload = Payload::retrieve('fine-tunes', $fineTuneId);

        /** @var Response<array{id: string, object: string, model: string, created_at: int, events: array<int, array{object: string, created_at: int, level: string, message: string}>, fine_tuned_model: ?string, hyperparams: array{batch_size: ?int, learning_rate_multiplier: ?float, n_epochs: int, prompt_loss_weight: float}, organization_id: string, result_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, status: string, validation_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, training_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, updated_at: int}>  $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data(), $response->meta());
    }

    /**
     * Immediately cancel a fine-tune job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/cancel
     */
    public function cancel(string $fineTuneId): RetrieveResponse
    {
        $payload = Payload::cancel('fine-tunes', $fineTuneId);

        /** @var Response<array{id: string, object: string, model: string, created_at: int, events: array<int, array{object: string, created_at: int, level: string, message: string}>, fine_tuned_model: ?string, hyperparams: array{batch_size: ?int, learning_rate_multiplier: ?float, n_epochs: int, prompt_loss_weight: float}, organization_id: string, result_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, status: string, validation_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, training_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, updated_at: int}>  $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data(), $response->meta());
    }

    /**
     * Get fine-grained status updates for a fine-tune job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/events
     */
    public function listEvents(string $fineTuneId): ListEventsResponse
    {
        $payload = Payload::retrieve('fine-tunes', $fineTuneId, '/events');

        /** @var Response<array{object: string, data: array<int, array{object: string, created_at: int, level: string, message: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListEventsResponse::from($response->data(), $response->meta());
    }

    /**
     * Get streamed fine-grained status updates for a fine-tune job.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/events
     *
     * @return StreamResponse<RetrieveStreamedResponseEvent>
     */
    public function listEventsStreamed(string $fineTuneId): StreamResponse
    {
        $payload = Payload::retrieve('fine-tunes', $fineTuneId, '/events?stream=true');

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(RetrieveStreamedResponseEvent::class, $response);
    }
}
