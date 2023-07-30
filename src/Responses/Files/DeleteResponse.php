<?php

declare(strict_types=1);

namespace OpenAI\Responses\Files;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\ResponseMetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, deleted: bool}>
 */
final class DeleteResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, deleted: bool}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly bool $deleted,
        public readonly ResponseMetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, deleted: bool}  $attributes
     */
    public static function from(array $attributes, ResponseMetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['deleted'],
            $meta,
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
            'deleted' => $this->deleted,
        ];
    }

    public function meta(): ResponseMetaInformation
    {
        return $this->meta;
    }
}
