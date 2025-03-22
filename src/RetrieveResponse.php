<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\StringableContract;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>}>
 */
final class RetrieveResponse implements ResponseContract, ResponseHasMetaInformationContract, StringableContract
{
    use ArrayAccessible;
    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        /**
         * The response id.
         */
        public readonly string $id,

        /**
         * The object type, which is always response.
         */
        public readonly string $object,

        /**
         * The Unix timestamp (in seconds) when the response was created.
         */
        public readonly int $createdAt,

        /**
         * The status of the response.
         */
        public readonly string $status,

        /**
         * The model used for response.
         */
        public readonly string $model,

        /**
         * The output of the response.
         *
         * @var array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>
         */
        public readonly array $output,

        /**
         * Set of 16 key-value pairs that can be attached to the object.
         * This can be useful for storing additional information about the object in a structured format.
         */
        public readonly array $metadata,

        /**
         * The input for the response.
         *
         * @var string|array
         */
        public readonly string|array $input = [],

        public readonly ?array $error = null,
        public readonly ?array $incompleteDetails = null,
        public readonly ?string $instructions = null,
        public readonly ?int $maxOutputTokens = null,
        public readonly bool $parallelToolCalls = false,
        public readonly ?string $previousResponseId = null,
        public readonly array $reasoning = [],
        public readonly bool $store = false,
        public readonly ?float $temperature = null,
        public readonly array $text = [],
        public readonly string $toolChoice = 'auto',
        public readonly array $tools = [],
        public readonly ?float $topP = null,
        public readonly string $truncation = 'disabled',
        public readonly ?array $usage = null,
        public readonly ?string $user = null,
    ) {
    }

    /**
     * @param array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $attributes
     */
    public static function from(array $attributes, array $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['status'],
            $attributes['model'],
            $attributes['output'],
            $attributes['metadata'] ?? [],
            $attributes['input'] ?? [],
            $attributes['error'] ?? null,
            $attributes['incomplete_details'] ?? null,
            $attributes['instructions'] ?? null,
            $attributes['max_output_tokens'] ?? null,
            $attributes['parallel_tool_calls'] ?? false,
            $attributes['previous_response_id'] ?? null,
            $attributes['reasoning'] ?? [],
            $attributes['store'] ?? false,
            $attributes['temperature'] ?? null,
            $attributes['text'] ?? [],
            $attributes['toolChoice'] ?? 'auto',
            $attributes['tools'] ?? [],
            $attributes['topP'] ?? null,
            $attributes['truncation'] ?? 'disabled',
            $attributes['usage'] ?? null,
            $attributes['user'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'createdAt' => $this->createdAt,
            'status' => $this->status,
            'model' => $this->model,
            'output' => $this->output,
            'metadata' => $this->metadata,
            'input' => $this->input,
            'error' => $this->error,
            'incomplete_details' => $this->incompleteDetails,
            'instructions' => $this->instructions,
            'max_output_tokens' => $this->maxOutputTokens,
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
            'usage' => $this->usage,
            'user' => $this->user,
        ];
    }
}