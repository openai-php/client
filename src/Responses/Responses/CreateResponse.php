<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, status: string, error: object|null, incomplete_details: object|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: string|null, metadata?: array<string, string>}>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, status: string, error: object|null, incomplete_details: object|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: string|null, metadata?: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>  $output
     * @param  array<mixed>  $reasoning
     * @param  array{format: array{type: string}}  $text
     * @param  array<mixed>  $tools
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly string $status,
        public readonly ?object $error,
        public readonly ?object $incompleteDetails,
        public readonly ?string $instructions,
        public readonly ?int $maxOutputTokens,
        public readonly string $model,
        public readonly array $output,
        public readonly bool $parallelToolCalls,
        public readonly ?string $previousResponseId,
        public readonly array $reasoning,
        public readonly bool $store,
        public readonly ?float $temperature,
        public readonly array $text,
        public readonly string $toolChoice,
        public readonly array $tools,
        public readonly ?float $topP,
        public readonly string $truncation,
        public readonly CreateResponseUsage $usage,
        public readonly ?string $user,
        public readonly array $metadata,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  array{id: string, object: string, created_at: int, status: string, error: object|null, incomplete_details: object|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['status'],
            $attributes['error'],
            $attributes['incomplete_details'],
            $attributes['instructions'],
            $attributes['max_output_tokens'],
            $attributes['model'],
            $attributes['output'],
            $attributes['parallel_tool_calls'],
            $attributes['previous_response_id'],
            $attributes['reasoning'],
            $attributes['store'],
            $attributes['temperature'],
            $attributes['text'],
            $attributes['tool_choice'],
            $attributes['tools'],
            $attributes['top_p'],
            $attributes['truncation'],
            CreateResponseUsage::from($attributes['usage']),
            $attributes['user'] ?? null,
            $attributes['metadata'] ?? [],
            $meta,
        );
    }

    /**
     * @return array{id: string, object: string, created_at: int, status: string, error: object|null, incomplete_details: object|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'status' => $this->status,
            'error' => $this->error,
            'incomplete_details' => $this->incompleteDetails,
            'instructions' => $this->instructions,
            'max_output_tokens' => $this->maxOutputTokens,
            'metadata' => $this->metadata,
            'model' => $this->model,
            'output' => $this->output,
            'parallel_tool_calls' => $this->parallelToolCalls,
            'previous_response_id' => $this->previousResponseId,
            'reasoning' => $this->reasoning,
            'store' => $this->store,
            'temperature' => $this->temperature,
            'text' => $this->text,
            'tool_choice' => $this->toolChoice,
            'tools' => $this->tools,
            'top_p' => $this->topP,
            'truncation' => $this->truncation,
            'usage' => $this->usage->toArray(),
            'user' => $this->user,
        ];
    }
}
