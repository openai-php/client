<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\ToolChoice;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type CustomToolChoiceType array{name: string, type: 'custom'}
 *
 * @implements ResponseContract<CustomToolChoiceType>
 */
final class CustomToolChoice implements ResponseContract
{
    /**
     * @use ArrayAccessible<CustomToolChoiceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'custom'  $type
     */
    private function __construct(
        public readonly string $name,
        public readonly string $type,
    ) {}

    /**
     * @param  CustomToolChoiceType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}
