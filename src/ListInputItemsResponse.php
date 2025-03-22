<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\StringableContract;
use OpenAI\Responses\Responses\Input\Data;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{id: string, object: string, content: string}>, first_id: ?string, last_id: ?string, has_more: bool}>
 */
final class ListInputItemsResponse implements ResponseContract, ResponseHasMetaInformationContract, StringableContract
{
    use ArrayAccessible;
    use HasMetaInformation;

    /**
     * @var array<int, Data>
     */
    public readonly array $data;

    private function __construct(
        /**
         * The object type, which is always "list".
         */
        public readonly string $object,

        /**
         * The list of input items.
         *
         * @var array<int, Data>
         */
        array $data,

        /**
         * The first input item ID in the list.
         */
        public readonly ?string $firstId,

        /**
         * The last input item ID in the list.
         */
        public readonly ?string $lastId,

        /**
         * Whether there are more input items available beyond this list.
         */
        public readonly bool $hasMore,
    ) {
        $this->data = $data;
    }

    /**
     * @param  array{object: string, data: array<int, array{id: string, object: string, content: string}>, first_id: ?string, last_id: ?string, has_more: bool}  $attributes
     */
    public static function from(array $attributes, array $meta): self
    {
        $data = array_map(static function (array $inputItem): Data {
            /** @var array{id: string, object: string, content: string} $inputItem */
            return Data::from($inputItem, []);
        }, $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
            $attributes['first_id'] ?? null,
            $attributes['last_id'] ?? null,
            $attributes['has_more'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->object;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(static fn (Data $inputItem): array => $inputItem->toArray(), $this->data),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}