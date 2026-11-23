<?php

declare(strict_types=1);

namespace OpenAI\Responses\VectorStores\Files;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{type: ?string, text: ?string}>, has_more: bool, next_page: ?string}>
 */
final class VectorStoreFileContentResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{type: ?string, text: ?string}>, has_more: bool, next_page: ?string}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, VectorStoreFileContentResponseChunk>  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly bool $hasMore,
        public readonly ?string $nextPage,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  array{object: string, data: array<int, array{type?: ?string, text?: ?string}>, has_more: bool, next_page?: ?string}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['object'],
            array_map(VectorStoreFileContentResponseChunk::from(...), $attributes['data']),
            $attributes['has_more'],
            $attributes['next_page'] ?? null,
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                static fn (VectorStoreFileContentResponseChunk $chunk): array => $chunk->toArray(),
                $this->data,
            ),
            'has_more' => $this->hasMore,
            'next_page' => $this->nextPage,
        ];
    }
}
