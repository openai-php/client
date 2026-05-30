<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool\CustomToolInputs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TextInputType array{type: 'text'}
 *
 * @implements ResponseContract<TextInputType>
 */
final class TextInput implements ResponseContract
{
    /**
     * @use ArrayAccessible<TextInputType>
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
     * @param  TextInputType  $attributes
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
