<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class FineTunes
{
    use Concerns\Transportable;

    /**
     * Creates a job that fine-tunes a specified model from a given dataset.
     *
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     *
     * @see https://beta.openai.com/docs/api-reference/fine-tunes/create
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, mixed>
     */
    public function create(array $parameters): array
    {
        $payload = Payload::create('fine-tunes', $parameters);

        /** @var array<string, mixed> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }

    /**
     * List your organization's fine-tuning jobs.
     *
     * @see https://beta.openai.com/docs/api-reference/fine-tunes/list
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    public function list(): array
    {
        $payload = Payload::list('fine-tunes');

        /** @var array<string, array<int, array<string, mixed>>> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }

    /**
     * Gets info about the fine-tune job.
     *
     * @see https://beta.openai.com/docs/api-reference/fine-tunes/list
     *
     * @return array<string, mixed>
     */
    public function retrieve(string $fineTuneId): array
    {
        $payload = Payload::retrieve('fine-tunes', $fineTuneId);

        return $this->transporter->requestObject($payload);
    }

    /**
     * Immediately cancel a fine-tune job.
     *
     * @see https://beta.openai.com/docs/api-reference/fine-tunes/cancel
     *
     * @return array<string, mixed>
     */
    public function cancel(string $fineTuneId): array
    {
        $payload = Payload::cancel('fine-tunes', $fineTuneId);

        return $this->transporter->requestObject($payload);
    }

    /**
     * Get fine-grained status updates for a fine-tune job.
     *
     * @see https://beta.openai.com/docs/api-reference/fine-tunes/events
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    public function listEvents(string $fineTuneId): array
    {
        $payload = Payload::retrieve('fine-tunes', $fineTuneId, '/events');

        /** @var array<string, array<int, array<string, mixed>>> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }
}
