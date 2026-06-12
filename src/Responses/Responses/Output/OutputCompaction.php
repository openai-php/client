<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputCompactionType array{id: string, encrypted_content: string, type: 'compaction', created_by?: string|null}
 *
 * @implements ResponseContract<OutputCompactionType>
 */
final class OutputCompaction implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputCompactionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'compaction'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly string $encryptedContent,
        public readonly string $type,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputCompactionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            encryptedContent: $attributes['encrypted_content'],
            type: $attributes['type'],
            createdBy: $attributes['created_by'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'encrypted_content' => $this->encryptedContent,
            'type' => $this->type,
            'created_by' => $this->createdBy,
        ];
    }
}
