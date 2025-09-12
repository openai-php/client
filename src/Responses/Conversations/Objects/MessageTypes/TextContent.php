<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations\Objects\MessageTypes;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TextContentType array{text: string, type: 'text'}
 *
 * @implements ResponseContract<TextContentType>
 */
final class TextContent implements ResponseContract
{
    /**
     * @use ArrayAccessible<TextContentType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'text'  $type
     */
    private function __construct(
        public readonly string $text,
        public readonly string $type
    ) {}

    /**
     * @param  TextContentType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            text: $attributes['text'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'type' => $this->type,
        ];
    }
}
