<?php

declare(strict_types=1);

namespace OpenAI\Responses\VectorStores;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}>
 */
final class VectorStoreResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly ?string $name,
        public readonly int $usageBytes,
        public readonly VectorStoreResponseFileCounts $fileCounts,
        public readonly string $status,
        public readonly ?VectorStoreResponseExpiresAfter $expiresAfter,
        public readonly ?int $expiresAt,
        public readonly ?int $lastActiveAt,
        public readonly array $metadata,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['name'],
            $attributes['usage_bytes'],
            VectorStoreResponseFileCounts::from($attributes['file_counts']),
            $attributes['status'],
            isset($attributes['expires_after']) ? VectorStoreResponseExpiresAfter::from($attributes['expires_after']) : null,
            $attributes['expires_at'],
            $attributes['last_active_at'],
            $attributes['metadata'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return array{id: string, object: string, name: string|null, status: string, usage_bytes: int, created_at: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, metadata: mixed[], expires_after: array{anchor: string, days: int}|null, expires_at: int|null, last_active_at: int|null}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'name' => $this->name,
            'status' => $this->status,
            'usage_bytes' => $this->usageBytes,
            'created_at' => $this->createdAt,
            'file_counts' => $this->fileCounts->toArray(),
            'metadata' => $this->metadata,
            'expires_after' => $this->expiresAfter?->toArray(),
            'expires_at' => $this->expiresAt,
            'last_active_at' => $this->lastActiveAt,
        ];
    }
}
