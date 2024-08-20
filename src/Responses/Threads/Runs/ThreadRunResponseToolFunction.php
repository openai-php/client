<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>
 */
final class ThreadRunResponseToolFunction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $type,
        public ThreadRunResponseToolFunctionFunction $function,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            ThreadRunResponseToolFunctionFunction::from($attributes['function']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'function' => $this->function->toArray(),
        ];
    }
}
