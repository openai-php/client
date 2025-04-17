<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Format;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'text'}>
 */
final class TextFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'text'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'text'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: 'text'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
