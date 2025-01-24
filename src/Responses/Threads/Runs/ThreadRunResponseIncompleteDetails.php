<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{reason: string}>
 */
final class ThreadRunResponseIncompleteDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{reason: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $reason,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{reason: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['reason'],
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
