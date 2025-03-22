<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\StringableContract;

/**
 * @implements ResponseContract<array{id: string, object: string, content: string}>
 */
final class Data implements ResponseContract, ResponseHasMetaInformationContract, StringableContract
{
    use ArrayAccessible;
    use HasMetaInformation;

    private function __construct(
        /**
         * The input id.
         */
        public readonly string $id,

        /**
         * The object type, which is always input.
         */
        public readonly string $object,

        /**
         * The content of the input.
         */
        public readonly string $content,
    ) {
    }

    /**
     * @param  array{id: string, object: string, content: string}  $attributes
     */
    public static function from(array $attributes, array $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['content'],
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
            'content' => $this->content,
        ];
    }
}