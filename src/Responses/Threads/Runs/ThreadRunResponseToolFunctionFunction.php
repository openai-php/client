<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{description: string, name: string, parameters: string}>
 */
final class ThreadRunResponseToolFunctionFunction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{description: string, name: string, parameters: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $description,
        public string $name,
        public string $parameters,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{description: string, name: string, parameters: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['description'],
            $attributes['name'],
            $attributes['parameters'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'name' => $this->name,
            'parameters' => $this->parameters,
        ];
    }
}
