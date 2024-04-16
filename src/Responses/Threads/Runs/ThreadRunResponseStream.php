<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int|null, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
 */
final class ThreadRunResponseStream implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, delta: array<string, mixed>|null, step_details: array<string, mixed>|null, created_at: int|null, thread_id: string|null, assistant_id: string|null, status: string|null, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}|null, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string|null, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>|null, metadata: array<string, string>|null, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}|null}>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    /**
     * @param  array<int, ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction>  $tools
     * @param  array<string, mixed>|null  $delta
     * @param  array<string, mixed>|null  $stepDetails
     * @param  array<int, string>  $fileIds
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public ?array $delta,
        public ?array $stepDetails,
        public ?int $createdAt,
        public string $threadId,
        public string $assistantId,
        public ?string $runId,
        public ?string $type,
        public string $status,
        public ?ThreadRunResponseRequiredAction $requiredAction,
        public ?ThreadRunResponseLastError $lastError,
        public ?int $expiresAt,
        public ?int $startedAt,
        public ?int $cancelledAt,
        public ?int $failedAt,
        public ?int $completedAt,
        public string $model,
        public ?string $instructions,
        public array $tools,
        public array $fileIds,
        public array $metadata,
        public ?ThreadRunResponseUsage $usage,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, delta: array<string,mixed>|null, step_details: array<string,mixed>|null, created_at: int|null, thread_id: string|null, assistant_id: string|null, run_id:string|null, type:string|null, status: string|null, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}|null, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string|null, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>|null, file_ids: array<int, string>|null, metadata: array<string, string>|null, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        $tools = isset($attributes['tools']) ? array_map(
            fn (array $tool
            ): ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction => match ($tool['type']) {
                'code_interpreter' => ThreadRunResponseToolCodeInterpreter::from($tool),
                'retrieval' => ThreadRunResponseToolRetrieval::from($tool),
                'function' => ThreadRunResponseToolFunction::from($tool),
            },
            $attributes['tools'],
        ) : [];

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['delta'] ?? [],
            $attributes['step_details'] ?? [],
            $attributes['created_at'] ?? null,
            $attributes['thread_id'] ?? '',
            $attributes['assistant_id'] ?? '',
            $attributes['run_id'] ?? '',
            $attributes['type'] ?? '',
            $attributes['status'] ?? '',
            isset($attributes['required_action']) ? ThreadRunResponseRequiredAction::from(
                $attributes['required_action']
            ) : null,
            isset($attributes['last_error']) ? ThreadRunResponseLastError::from($attributes['last_error']) : null,
            $attributes['expires_at'] ?? null,
            $attributes['started_at'] ?? null,
            $attributes['cancelled_at'] ?? null,
            $attributes['failed_at'] ?? null,
            $attributes['completed_at'] ?? null,
            $attributes['model'] ?? '',
            $attributes['instructions'] ?? '',
            $tools,
            $attributes['file_ids'] ?? [],
            $attributes['metadata'] ?? [],
            isset($attributes['usage']) ? ThreadRunResponseUsage::from($attributes['usage']) : null,
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
            'delta' => $this->delta,
            'step_details' => $this->stepDetails,
            'created_at' => $this->createdAt,
            'assistant_id' => $this->assistantId,
            'run_id' => $this->runId,
            'type' => $this->type,
            'thread_id' => $this->threadId,
            'status' => $this->status,
            'started_at' => $this->startedAt,
            'expires_at' => $this->expiresAt,
            'cancelled_at' => $this->cancelledAt,
            'failed_at' => $this->failedAt,
            'completed_at' => $this->completedAt,
            'required_action' => $this->requiredAction?->toArray(),
            'last_error' => $this->lastError?->toArray(),
            'model' => $this->model,
            'instructions' => $this->instructions,
            'tools' => array_map(
                fn (
                    ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction $tool
                ): array => $tool->toArray(),
                $this->tools,
            ),
            'file_ids' => $this->fileIds,
            'metadata' => $this->metadata,
            'usage' => $this->usage?->toArray(),
        ];

        if ($data['required_action'] === null) {
            unset($data['required_action']);
        }

        if ($data['usage'] === null) {
            unset($data['usage']);
        }

        return $data;
    }
}
