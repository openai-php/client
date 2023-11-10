<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseLastError;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{}>
 */
final class ThreadRunStepResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public string $threadId,
        public string $assistantId,
        public string $runId,
        public string $type,
        public string $status,
        public ThreadRunStepResponseMessageCreationStepDetails|ThreadRunStepResponseToolCallsStepDetails $stepDetails,
        public ?ThreadRunResponseLastError $lastError,
        public ?int $expiresAt,
        public ?int $cancelledAt,
        public ?int $failedAt,
        public ?int $completedAt,
        public array $metadata,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{}  $attributes
     */
    public static function from(array|string $attributes, MetaInformation $meta): self
    {
        $stepDetails = match ($attributes['step_details']['type']) {
            'message_creation' => ThreadRunStepResponseMessageCreationStepDetails::from($attributes['step_details']),
            'tool_calls' => ThreadRunStepResponseToolCallsStepDetails::from($attributes['step_details']),
        };

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['thread_id'],
            $attributes['assistant_id'],
            $attributes['run_id'],
            $attributes['type'],
            $attributes['status'],
            $stepDetails,
            isset($attributes['last_error']) ? ThreadRunResponseLastError::from($attributes['last_error']) : null,
            $attributes['expires_at'],
            $attributes['cancelled_at'],
            $attributes['failed_at'],
            $attributes['completed_at'],
            $attributes['metadata'] ?? [],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'thread_id' => $this->threadId,
            'assistant_id' => $this->assistantId,
            'run_id' => $this->runId,
            'type' => $this->type,
            'status' => $this->status,
            'step_details' => $this->stepDetails?->toArray(),
            'last_error' => $this->lastError?->toArray(),
            'expires_at' => $this->expiresAt,
            'cancelled_at' => $this->cancelledAt,
            'failed_at' => $this->failedAt,
            'completed_at' => $this->completedAt,
            'metadata' => $this->metadata,
        ];
    }
}
