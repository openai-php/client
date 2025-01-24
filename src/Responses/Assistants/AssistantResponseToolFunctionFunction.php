<?php

declare(strict_types=1);

namespace OpenAI\Responses\Assistants;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{description: ?string, name: string, parameters: array<string, mixed>}>
 */
final class AssistantResponseToolFunctionFunction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{description: ?string, name: string, parameters: array<string, mixed>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        public ?string $description,
        public string $name,
        public array $parameters,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{description: ?string, name: string, parameters: array<string, mixed>}  $attributes
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
            'name' => $this->name,
            'description' => $this->description,
            'parameters' => $this->parameters,
        ];
    }
}
