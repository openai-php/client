<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}>
 */
final class FileSearchTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $vectorStoreIds
     * @param  'file_search'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly array $vectorStoreIds,
        public readonly FileSearchComparisonFilter|FileSearchCompoundFilter $filters,
        public readonly int $maxNumResults,
        public readonly FileSearchRankingOption $rankingOptions,
    ) {}

    /**
     * @param  array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $filters = match ($attributes['filters']['type']) {
            'eq', 'ne', 'gt', 'gte', 'lt', 'lte' => FileSearchComparisonFilter::from($attributes['filters']),
            'and', 'or' => FileSearchCompoundFilter::from($attributes['filters']),
        };

        return new self(
            type: $attributes['type'],
            vectorStoreIds: $attributes['vector_store_ids'],
            filters: $filters,
            maxNumResults: $attributes['max_num_results'],
            rankingOptions: FileSearchRankingOption::from($attributes['ranking_options']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'vector_store_ids' => $this->vectorStoreIds,
            'filters' => $this->filters->toArray(),
            'max_num_results' => $this->maxNumResults,
            'ranking_options' => $this->rankingOptions->toArray(),
        ];
    }
}
