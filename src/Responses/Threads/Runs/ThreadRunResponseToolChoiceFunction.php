<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{name: string}>
 */
final class ThreadRunResponseToolChoiceFunction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{name: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $name,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{name: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
