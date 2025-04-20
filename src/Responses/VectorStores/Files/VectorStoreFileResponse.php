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
 * @implements ResponseContract<array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}>
 */
final class VectorStoreFileResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<string, string>  $attributes
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $usageBytes,
        public readonly int $createdAt,
        public readonly string $vectorStoreId,
        public readonly string $status,
        public readonly array $attributes,
        public readonly ?VectorStoreFileResponseLastError $lastError,
        public readonly VectorStoreFileResponseChunkingStrategyStatic|VectorStoreFileResponseChunkingStrategyOther $chunkingStrategy,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: ?array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['usage_bytes'],
            $attributes['created_at'],
            $attributes['vector_store_id'],
            $attributes['status'],
            $attributes['attributes'] ?? [],
            isset($attributes['last_error']) ? VectorStoreFileResponseLastError::from($attributes['last_error']) : null,
            $attributes['chunking_strategy']['type'] === 'static' ? VectorStoreFileResponseChunkingStrategyStatic::from($attributes['chunking_strategy']) : VectorStoreFileResponseChunkingStrategyOther::from($attributes['chunking_strategy']),
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
            'usage_bytes' => $this->usageBytes,
            'created_at' => $this->createdAt,
            'vector_store_id' => $this->vectorStoreId,
            'status' => $this->status,
            'attributes' => $this->attributes,
            'last_error' => $this->lastError instanceof VectorStoreFileResponseLastError ? $this->lastError->toArray() : null,
            'chunking_strategy' => $this->chunkingStrategy->toArray(),
        ];
    }
}
