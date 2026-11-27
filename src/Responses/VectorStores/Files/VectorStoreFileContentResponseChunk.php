<?php

declare(strict_types=1);

namespace OpenAI\Responses\VectorStores\Files;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{type: ?string, text: ?string}>
 */
final class VectorStoreFileContentResponseChunk implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: ?string, text: ?string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly ?string $type,
        public readonly ?string $text,
    ) {}

    /**
     * @param  array{type?: ?string, text?: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'] ?? null,
            text: $attributes['text'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'text' => $this->text,
        ];
    }
}
