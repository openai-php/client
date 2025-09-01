<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ConversationItemType from ConversationItem
 *
 * @phpstan-type ConversationItemListType array{object: 'list', data: array<int, ConversationItemType>, first_id: ?string, last_id: ?string, has_more: bool}
 *
 * @implements ResponseContract<ConversationItemListType>
 */
final class ConversationItemList implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ConversationItemListType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'list'  $object
     * @param  array<int, ConversationItem>  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly ?string $firstId,
        public readonly ?string $lastId,
        public readonly bool $hasMore,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ConversationItemListType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $items = array_map(
            static fn (array $item): ConversationItem => ConversationItem::from($item),
            $attributes['data'],
        );

        return new self(
            object: $attributes['object'],
            data: $items,
            firstId: $attributes['first_id'] ?? null,
            lastId: $attributes['last_id'] ?? null,
            hasMore: $attributes['has_more'],
            meta: $meta,
        );
    }

    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(static fn (ConversationItem $i): array => $i->toArray(), $this->data),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
