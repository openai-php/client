<?php

declare(strict_types=1);

namespace OpenAI\Responses\VectorStores\Search;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{object: string, search_query: string|array<mixed>, data: array<int, array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}>, has_more: bool, next_page: ?string}>
 */
final class VectorStoreSearchResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{object: string, search_query: string|array<mixed>, data: array<int, array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}>, has_more: bool, next_page: ?string}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, VectorStoreSearchResponseFile>  $data
     * @param  string|array<mixed>  $searchQuery
     */
    private function __construct(
        public readonly string $object,
        public readonly string|array $searchQuery,
        public readonly array $data,
        public readonly bool $hasMore,
        public readonly ?string $nextPage,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, search_query: string|array<mixed>, data: array<int, array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}>, has_more: bool, next_page: ?string}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(
            static fn (array $result): VectorStoreSearchResponseFile => VectorStoreSearchResponseFile::from($result),
            $attributes['data']
        );

        return new self(
            $attributes['object'],
            $attributes['search_query'],
            $data,
            $attributes['has_more'],
            $attributes['next_page'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return array{object: string, search_query: string|array<mixed>, data: array<int, array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}>, has_more: bool, next_page: ?string}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'search_query' => $this->searchQuery,
            'data' => array_map(
                static fn (VectorStoreSearchResponseFile $item): array => $item->toArray(),
                $this->data
            ),
            'has_more' => $this->hasMore,
            'next_page' => $this->nextPage,
        ];
    }
}
