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
 * @implements ResponseContract<array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, last_error: ?array{code: string, message: string}}>
 */
final class VectorStoreFileResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, last_error: ?array{code: string, message: string}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $usageBytes,
        public readonly int $createdAt,
        public readonly string $vectorStoreId,
        public readonly string $status,
        public readonly ?VectorStoreFileLastErrorResponse $lastError,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, last_error: ?array{code: string, message: string}}  $attributes
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
            isset($attributes['last_error']) ? VectorStoreFileLastErrorResponse::from($attributes['last_error']) : null,
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
            'last_error' => $this->lastError instanceof VectorStoreFileLastErrorResponse ? $this->lastError->toArray() : null,
        ];
    }
}
