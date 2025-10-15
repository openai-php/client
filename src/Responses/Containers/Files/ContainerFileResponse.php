<?php

declare(strict_types=1);

namespace OpenAI\Responses\Containers\Files;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ContainerFileType array{id: string, object: 'container.file', created_at: int, bytes: int|null, container_id: string, path: string, source: 'user'|'assistant'}
 *
 * @implements ResponseContract<ContainerFileType>
 */
final class ContainerFileResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ContainerFileType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'container.file'  $object
     * @param  'user'|'assistant'  $source
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly ?int $bytes,
        public readonly string $containerId,
        public readonly string $path,
        public readonly string $source,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  ContainerFileType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            bytes: $attributes['bytes'],
            containerId: $attributes['container_id'],
            path: $attributes['path'],
            source: $attributes['source'],
            meta: $meta,
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
            'created_at' => $this->createdAt,
            'bytes' => $this->bytes,
            'container_id' => $this->containerId,
            'path' => $this->path,
            'source' => $this->source,
        ];
    }
}
