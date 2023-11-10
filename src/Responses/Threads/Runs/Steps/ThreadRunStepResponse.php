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
 * @implements ResponseContract<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: string, tool_calls: array<int, array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}|array{id: string, type: string, retrieval: array<string, string>}|array{id: string, type: string, function: array{name: string, arguments: string, output: ?string}}>}|array{type: string, message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}>
 */
final class ThreadRunStepResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: string, tool_calls: array<int, array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}|array{id: string, type: string, retrieval: array<string, string>}|array{id: string, type: string, function: array{name: string, arguments: string, output: ?string}}>}|array{type: string, message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<string, string>  $metadata
     */
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
     * @param  array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'retrieval', retrieval: array<string, string>}|array{id: string, type: 'function', function: array{name: string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
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
        $data = [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'run_id' => $this->runId,
            'assistant_id' => $this->assistantId,
            'thread_id' => $this->threadId,
            'type' => $this->type,
            'status' => $this->status,
            'cancelled_at' => $this->cancelledAt,
            'completed_at' => $this->completedAt,
            'expires_at' => $this->expiresAt,
            'failed_at' => $this->failedAt,
            'last_error' => $this->lastError?->toArray(),
            'step_details' => $this->stepDetails->toArray(),
        ];

        if ($this->metadata !== []) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
    }
}
