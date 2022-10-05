<?php

declare(strict_types=1);

namespace OpenAI\Responses\Files;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $bytes,
        public readonly int $createdAt,
        public readonly string $filename,
        public readonly string $purpose,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['bytes'],
            $attributes['created_at'],
            $attributes['filename'],
            $attributes['purpose'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'bytes' => $this->bytes,
            'created_at' => $this->createdAt,
            'filename' => $this->filename,
            'purpose' => $this->purpose,
        ];
    }
}
