<?php

declare(strict_types=1);

namespace OpenAI\Responses\Containers;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type RetrieveContainerType from RetrieveContainer
 *
 * @phpstan-type ListContainersType array{object: 'list', data: RetrieveContainerType[], first_id: string|null, last_id: string|null, has_more: bool}
 *
 * @implements ResponseContract<ListContainersType>
 */
final class ListContainers implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ListContainersType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'list'  $object
     * @param  RetrieveContainer[]  $data
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
     * @param  ListContainersType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            object: $attributes['object'],
            data: array_map(
                fn (array $container): RetrieveContainer => RetrieveContainer::from($container, $meta),
                $attributes['data']
            ),
            firstId: $attributes['first_id'] ?? null,
            lastId: $attributes['last_id'] ?? null,
            hasMore: $attributes['has_more'],
            meta: $meta,
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
                fn (RetrieveContainer $container): array => $container->toArray(),
                $this->data
            ),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
