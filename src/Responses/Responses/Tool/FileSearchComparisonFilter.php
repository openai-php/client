<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ComparisonFilterType array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}
 *
 * @implements ResponseContract<ComparisonFilterType>
 */
final class FileSearchComparisonFilter implements ResponseContract
{
    /**
     * @use ArrayAccessible<ComparisonFilterType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'eq'|'ne'|'gt'|'gte'|'lt'|'lte'  $type
     */
    private function __construct(
        public readonly string $key,
        public readonly string $type,
        public readonly string|int|bool $value,
    ) {}

    /**
     * @param  ComparisonFilterType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            key: $attributes['key'],
            type: $attributes['type'],
            value: $attributes['value'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
