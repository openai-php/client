<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}>
 */
final class ThreadRunResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction>  $tools
     * @param  array<int, string>  $fileIds
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public string $threadId,
        public string $assistantId,
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
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $tools = array_map(
            fn (array $tool): ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction => match ($tool['type']) {
                'code_interpreter' => ThreadRunResponseToolCodeInterpreter::from($tool),
                'retrieval' => ThreadRunResponseToolRetrieval::from($tool),
                'function' => ThreadRunResponseToolFunction::from($tool),
            },
            $attributes['tools'],
        );

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['thread_id'],
            $attributes['assistant_id'],
            $attributes['status'],
            isset($attributes['required_action']) ? ThreadRunResponseRequiredAction::from($attributes['required_action']) : null,
            isset($attributes['last_error']) ? ThreadRunResponseLastError::from($attributes['last_error']) : null,
            $attributes['expires_at'],
            $attributes['started_at'],
            $attributes['cancelled_at'],
            $attributes['failed_at'],
            $attributes['completed_at'],
            $attributes['model'],
            $attributes['instructions'],
            $tools,
            $attributes['file_ids'],
            $attributes['metadata'],
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
            'assistant_id' => $this->assistantId,
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
                fn (ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction $tool): array => $tool->toArray(),
                $this->tools,
            ),
            'file_ids' => $this->fileIds,
            'metadata' => $this->metadata,
        ];

        if ($data['required_action'] === null) {
            unset($data['required_action']);
        }

        return $data;
    }
}
