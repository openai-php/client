<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\StringableContract;

/**
 * @implements ResponseContract<array{id: string, object: string, deleted: bool}>
 */
final class DeleteResponse implements ResponseContract, ResponseHasMetaInformationContract, StringableContract
{
    use ArrayAccessible;
    use HasMetaInformation;

    private function __construct(
        /**
         * The response id.
         */
        public readonly string $id,

        /**
         * The object type, which is always response.
         */
        public readonly string $object,

        /**
         * Whether the response was successfully deleted.
         */
        public readonly bool $deleted,
    ) {
    }

    /**
     * @param array{id: string, object: string, deleted: bool} $attributes
     */
    public static function from(array $attributes, array $meta): self
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
    public function toString(): string
    {
        return $this->id;
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
}