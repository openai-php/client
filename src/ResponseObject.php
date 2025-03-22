<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\StringableContract;
use OpenAI\Responses\Responses\Input\Data;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, response_id: string, status: string,, array{index: int, content: string}>, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, text: array{format: array{type: string}}, reasoning: array<string, mixed>, instructions: ?string, parallel_tool_calls: bool, tools: array<mixed>, tool_choice: string, top_p: ?float, temperature: ?float, max_output_tokens: ?int, store: bool, user: ?string, previous_response_id: ?string, metadata: array<string, string>}>
 */
final class ResponseObject implements ResponseContract, ResponseHasMetaInformationContract, StringableContract
{
    use ArrayAccessible;
    use HasMetaInformation;

    /**
     * @var array<int, Data>
     */

    private function __construct(
        /**
         * The response id.
         */
        public readonly string $id,

        /**
         * The object type, which is always model.response.
         */
        public readonly string $object,

        /**
         * The Unix timestamp (in seconds) when the response was created.
         */
        public readonly int $createdAt,

        /**
         * The response id.
         */
        public readonly string $responseId,

        /**
         * The status of the response, which can be “pending”, “processing”, “complete”, “error”, or “cancelled”.
         */
        public readonly string $status,


        /**
         * The usage information for the response.
         */
        public readonly array $usage,

        /**
         * The error information for the response, if any.
         */
        public readonly ?array $error,

        /**
         * The incomplete details information for the response, if any.
         */
        public readonly ?array $incompleteDetails,

        /**
         * The text format information for the response.
         */
        public readonly array $text,

        /**
         * The reasoning information for the response.
         */
        public readonly array $reasoning,

        /**
         * The instructions for the response, if any.
         */
        public readonly ?string $instructions,

        /**
         * Whether parallel tool calls were used for the response.
         */
        public readonly bool $parallelToolCalls,

        /**
         * The tools used for the response.
         */
        public readonly array $tools,

        /**
         * The tool choice for the response.
         */
        public readonly string $toolChoice,

        /**
         * The top_p value for the response.
         */
        public readonly ?float $topP,

        /**
         * The temperature value for the response.
         */
        public readonly ?float $temperature,

        /**
         * The maximum output tokens for the response, if any.
         */
        public readonly ?int $maxOutputTokens,

        /**
         * Whether the response was stored.
         */
        public readonly bool $store,

        /**
         * The user ID associated with the response, if any.
         */
        public readonly ?string $user,

        /**
         * The ID of the previous response, if any.
         */
        public readonly ?string $previousResponseId,


        /**
         * Set of 16 key-value pairs that can be attached to the object.
         * This can be useful for storing additional information about the object in a structured format.
         */
        public readonly array $metadata,
    ) {
    }

    /**
     * @param  array{id: string, object: string, created_at: int, response_id: string, status: string, array{index: int, content: string}>, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, text: array{format: array{type: string}}, reasoning: array<string, mixed>, instructions: ?string, parallel_tool_calls: bool, tools: array<mixed>, tool_choice: string, top_p: ?float, temperature: ?float, max_output_tokens: ?int, store: bool, user: ?string, previous_response_id: ?string, metadata: array<string, string>}  $attributes
     */
    public static function from(array $attributes, array $meta): self
    {


        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['response_id'],
            $attributes['status'],
            $attributes['usage'],
            $attributes['error'],
            $attributes['incomplete_details'],
            $attributes['text'],
            $attributes['reasoning'],
            $attributes['instructions'],
            $attributes['parallel_tool_calls'],
            $attributes['tools'],
            $attributes['tool_choice'],
            $attributes['top_p'],
            $attributes['temperature'],
            $attributes['max_output_tokens'],
            $attributes['store'],
            $attributes['user'],
            $attributes['previous_response_id'],
            $attributes['metadata'] ?? [],
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
            'response_id' => $this->responseId,
            'status' => $this->status,
            'usage' => $this->usage,
            'error' => $this->error,
            'incomplete_details' => $this->incompleteDetails,
            'text' => $this->text,
            'reasoning' => $this->reasoning,
            'instructions' => $this->instructions,
            'parallel_tool_calls' => $this->parallelToolCalls,
            'tools' => $this->tools,
            'tool_choice' => $this->toolChoice,
            'top_p' => $this->topP,
            'temperature' => $this->temperature,
            'max_output_tokens' => $this->maxOutputTokens,
            'store' => $this->store,
            'user' => $this->user,
            'previous_response_id' => $this->previousResponseId,
            'metadata' => $this->metadata,
        ];
    }
}