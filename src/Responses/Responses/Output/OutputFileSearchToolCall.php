<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}>
 */
final class OutputFileSearchToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string>  $queries
     * @param  'in_progress'|'searching'|'incomplete'|'failed'  $status
     * @param  'file_search_call'  $type
     * @param  ?array<int, OutputFileSearchToolCallResult>  $results
     */
    private function __construct(
        public readonly string $id,
        public readonly array $queries,
        public readonly string $status,
        public readonly string $type,
        public readonly ?array $results = null,
    ) {}

    /**
     * @param  array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $results = isset($attributes['results'])
            ? array_map(
                fn (array $result): OutputFileSearchToolCallResult => OutputFileSearchToolCallResult::from($result),
                $attributes['results']
            )
            : null;

        return new self(
            id: $attributes['id'],
            queries: $attributes['queries'],
            status: $attributes['status'],
            type: $attributes['type'],
            results: $results,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'queries' => $this->queries,
            'status' => $this->status,
            'type' => $this->type,
            'results' => isset($this->results) ? array_map(
                fn (OutputFileSearchToolCallResult $result) => $result->toArray(),
                $this->results
            ) : null,
        ];
    }
}
