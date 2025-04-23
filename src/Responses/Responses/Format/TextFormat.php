<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Format;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TextFormatType array{type: 'text'}
 *
 * @implements ResponseContract<TextFormatType>
 */
final class TextFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<TextFormatType>
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
     * @param  TextFormatType  $attributes
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
