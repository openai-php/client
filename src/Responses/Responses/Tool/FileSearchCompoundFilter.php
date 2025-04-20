<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}>
 */
final class FileSearchCompoundFilter implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, FileSearchComparisonFilter>  $filters
     * @param  'and'|'or'  $type
     */
    private function __construct(
        public readonly array $filters,
        public readonly string $type,
    ) {}

    /**
     * @param  array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}  $attributes
     */
    public static function from(array $attributes): self
    {
        $filters = array_map(
            static fn (array $filter): FileSearchComparisonFilter => FileSearchComparisonFilter::from($filter),
            $attributes['filters'],
        );

        return new self(
            filters: $filters,
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'filters' => array_map(
                static fn (FileSearchComparisonFilter $filter): array => $filter->toArray(),
                $this->filters,
            ),
            'type' => $this->type,
        ];
    }
}
