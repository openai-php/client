<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>}>
 */
final class RetrieveResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>
     */
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
         * The input for the response.
         *
         * @var string|array
         */
        public readonly string|array $input = [],

        public readonly object|null $error = null,
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
        public readonly ?string $user = null,
        public readonly CreateResponseUsage $usage,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     * 
     * @param array{id: string, object: string, created_at: int, status: string, error: ??object, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>, input: string|array} $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['status'],
            $attributes['model'],
            $attributes['output'],
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
            $attributes['tool_choice'] ?? 'auto',
            $attributes['tools'] ?? [],
            $attributes['top_p'] ?? null,
            $attributes['truncation'] ?? 'disabled',
            $attributes['user'] ?? null,
            CreateResponseUsage::from($attributes['usage']),
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
            'status' => $this->status,
            'model' => $this->model,
            'output' => $this->output,
            'metadata' => $this->meta->toArray(),
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
            'user' => $this->user,
            'usage' => $this->usage->toArray(),
        ];
    }
}