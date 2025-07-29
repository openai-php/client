<?php

declare(strict_types=1);

namespace OpenAI\Responses\Containers\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ExpiresAfterType array{anchor: 'last_active_at', minutes: int}
 *
 * @implements ResponseContract<ExpiresAfterType>
 */
final class ExpiresAfter implements ResponseContract
{
    /**
     * @use ArrayAccessible<ExpiresAfterType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'last_active_at'  $anchor
     */
    private function __construct(
        public readonly string $anchor,
        public readonly int $minutes,
    ) {}

    /**
     * @param  ExpiresAfterType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            anchor: $attributes['anchor'],
            minutes: $attributes['minutes'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'anchor' => $this->anchor,
            'minutes' => $this->minutes,
        ];
    }
}
