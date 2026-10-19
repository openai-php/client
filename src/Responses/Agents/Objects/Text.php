<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TextFormatType array{type: 'text'}|array{type: 'json_schema', schema: array<string, mixed>}
 * @phpstan-type TextType array{format: TextFormatType, verbosity: string}
 *
 * @implements ResponseContract<TextType>
 */
final class Text implements ResponseContract
{
    /**
     * @use ArrayAccessible<TextType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  TextFormatType  $format
     */
    private function __construct(
        public readonly array $format,
        public readonly string $verbosity,
    ) {}

    /**
     * @param  TextType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            format: $attributes['format'],
            verbosity: $attributes['verbosity'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'format' => $this->format,
            'verbosity' => $this->verbosity,
        ];
    }
}
