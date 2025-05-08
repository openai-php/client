<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type IncompleteDetailsType array{reason: string}
 *
 * @implements ResponseContract<IncompleteDetailsType>
 */
final class CreateResponseIncompleteDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<IncompleteDetailsType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $reason,
    ) {}

    /**
     * @param  IncompleteDetailsType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            reason: $attributes['reason'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'reason' => $this->reason,
        ];
    }
}
