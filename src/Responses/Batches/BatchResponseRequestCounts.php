<?php

declare(strict_types=1);

namespace OpenAI\Responses\Batches;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{total: int, completed: int, failed: int}>
 */
final class BatchResponseRequestCounts implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{total: int, completed: int, failed: int}>
     */
    use ArrayAccessible;

    private function __construct(
        public int $total,
        public int $completed,
        public int $failed,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{total: int, completed: int, failed: int}  $attributes
     */
    public static function from(array $attributes): self
    {

        return new self(
            $attributes['total'],
            $attributes['completed'],
            $attributes['failed'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'completed' => $this->completed,
            'failed' => $this->failed,
        ];
    }
}
