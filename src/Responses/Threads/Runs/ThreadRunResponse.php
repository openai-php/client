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
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class ThreadRunResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction>  $tools
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
        public string $instructions,
        public array $tools,
        public array $fileIds,
        public array $metadata,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}|string  $attributes
     */
    public static function from(array|string $attributes, MetaInformation $meta): self
    {
        $tools = array_map(
            fn (array $tool): \OpenAI\Responses\Threads\Runs\ThreadRunResponseToolCodeInterpreter|\OpenAI\Responses\Threads\Runs\ThreadRunResponseToolRetrieval|\OpenAI\Responses\Threads\Runs\ThreadRunResponseToolFunction => match ($tool['type']) {
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
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'thread_id' => $this->threadId,
            'assistant_id' => $this->assistantId,
            'status' => $this->status,
            'required_action' => $this->requiredAction?->toArray(),
            'last_error' => $this->lastError?->toArray(),
            'expires_at' => $this->expiresAt,
            'started_at' => $this->startedAt,
            'cancelled_at' => $this->cancelledAt,
            'failed_at' => $this->failedAt,
            'completed_at' => $this->completedAt,
            'model' => $this->model,
            'instructions' => $this->instructions,
            'tools' => array_map(
                fn (ThreadRunResponseToolCodeInterpreter|ThreadRunResponseToolRetrieval|ThreadRunResponseToolFunction $tool): array => $tool->toArray(),
                $this->tools,
            ),
            'file_ids' => $this->fileIds,
            'metadata' => $this->metadata,
        ];
    }
}
