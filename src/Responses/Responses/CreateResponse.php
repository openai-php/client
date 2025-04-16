<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall as ComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall as FileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall as FunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputMessage as MessageCall;
use OpenAI\Responses\Responses\Output\OutputReasoning as ReasoningCall;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall as WebSearchToolCall;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: string|null, metadata?: array<string, string>}>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: string|null, metadata?: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'completed'|'failed'|'in_progress'|'incomplete'  $status
     * @param  array<int, MessageCall|ComputerToolCall|FileSearchToolCall|WebSearchToolCall|FunctionToolCall|ReasoningCall>  $output
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
        public readonly ?CreateResponseError $error,
        public readonly ?CreateResponseIncompleteDetails $incompleteDetails,
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
     * @param  array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: array<mixed>, store: bool, temperature: float|null, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: float|null, truncation: string, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $output = array_map(
            fn (array $output): MessageCall|ComputerToolCall|FileSearchToolCall|WebSearchToolCall|FunctionToolCall|ReasoningCall => match ($output['type']) {
                'message' => MessageCall::from($output),
                'file_search_call' => FileSearchToolCall::from($output),
                'function_call' => FunctionToolCall::from($output),
                'web_search_call' => WebSearchToolCall::from($output),
                'computer_call' => ComputerToolCall::from($output),
                'reasoning' => ReasoningCall::from($output),
            },
            $attributes['output'],
        );

        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            status: $attributes['status'],
            error: isset($attributes['error'])
                ? CreateResponseError::from($attributes['error'])
                : null,
            incompleteDetails: isset($attributes['incomplete_details'])
                ? CreateResponseIncompleteDetails::from($attributes['incomplete_details'])
                : null,
            instructions: $attributes['instructions'],
            maxOutputTokens: $attributes['max_output_tokens'],
            model: $attributes['model'],
            output: $output,
            parallelToolCalls: $attributes['parallel_tool_calls'],
            previousResponseId: $attributes['previous_response_id'],
            reasoning: $attributes['reasoning'],
            store: $attributes['store'],
            temperature: $attributes['temperature'],
            text: $attributes['text'],
            toolChoice: $attributes['tool_choice'],
            tools: $attributes['tools'],
            topP: $attributes['top_p'],
            truncation: $attributes['truncation'],
            usage: CreateResponseUsage::from($attributes['usage']),
            user: $attributes['user'] ?? null,
            metadata: $attributes['metadata'] ?? [],
            meta: $meta,
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
            'error' => $this->error?->toArray(),
            'incomplete_details' => $this->incompleteDetails?->toArray(),
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
