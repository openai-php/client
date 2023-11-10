<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{description: string, name: string, parameters: array<string, mixed>}>
 */
final class ThreadRunResponseToolFunctionFunction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{description: string, name: string, parameters: array<string, mixed>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        public string $name,
        public string $description,
        public array $parameters,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{description: string, name: string, parameters: array<string, mixed>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            $attributes['description'],
            $attributes['parameters'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'parameters' => $this->parameters,
        ];
    }
}
