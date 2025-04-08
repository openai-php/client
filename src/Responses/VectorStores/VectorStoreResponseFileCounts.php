<?php

declare(strict_types=1);

namespace OpenAI\Responses\VectorStores;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}>
 */
final class VectorStoreResponseFileCounts implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $inProgress,
        public readonly int $completed,
        public readonly int $failed,
        public readonly int $cancelled,
        public readonly int $total,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['in_progress'],
            $attributes['completed'],
            $attributes['cancelled'],
            $attributes['failed'],
            $attributes['total'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'in_progress' => $this->inProgress,
            'completed' => $this->completed,
            'failed' => $this->failed,
            'cancelled' => $this->cancelled,
            'total' => $this->total,
        ];
    }
}
