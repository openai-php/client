<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputImageGenerationToolCallType array{id: string, result?: string|null, status: string, type: 'image_generation_call'}
 *
 * @implements ResponseContract<OutputImageGenerationToolCallType>
 */
final class OutputImageGenerationToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputImageGenerationToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'image_generation_call'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly ?string $result,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputImageGenerationToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            result: $attributes['result'] ?? null,
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'result' => $this->result,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
