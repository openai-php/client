<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ComparisonFilterType from FileSearchComparisonFilter
 *
 * @phpstan-type CompoundFilterType array{filters: array<int, ComparisonFilterType>, type: 'and'|'or'}
 *
 * @implements ResponseContract<CompoundFilterType>
 */
final class FileSearchCompoundFilter implements ResponseContract
{
    /**
     * @use ArrayAccessible<CompoundFilterType>
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
     * @param  CompoundFilterType  $attributes
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
