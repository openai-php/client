<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\StringableContract;
use OpenAI\Responses\Responses\ResponseObject;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}>
 */
final class ListResponse implements ResponseContract, ResponseHasMetaInformationContract, StringableContract
{
    use ArrayAccessible;
    use HasMetaInformation;

    /**
     * @var array<int, ResponseObject>
     */
    public readonly array $data;

    private function __construct(
        /**
         * The object type, which is always "list".
         */
        public readonly string $object,

        /**
         * The list of responses.
         *
         * @var array<int, ResponseObject>
         */
        array $data,

        /**
         * The first response ID in the list.
         */
        public readonly ?string $firstId,

        /**
         * The last response ID in the list.
         */
        public readonly ?string $lastId,

        /**
         * Whether there are more responses available beyond this list.
         */
        public readonly bool $hasMore,
    ) {
        $this->data = $data;
    }

    /**
     * @param  array{object: string, data: array<int, array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}  $attributes
     */
    public static function from(array $attributes, array $meta): self
    {
        $data = array_map(static function (array $response): ResponseObject {
            /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}},tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $response */
            return ResponseObject::from($response, []);
        }, $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
            $attributes['first_id'] ?? null,
            $attributes['last_id'] ?? null,
            $attributes['has_more'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->object;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(static fn (ResponseObject $response): array => $response->toArray(), $this->data),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}