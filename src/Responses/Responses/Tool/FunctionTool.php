<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}>
 */
final class FunctionTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $parameters
     * @param  'function'  $type
     */
    private function __construct(
        public readonly string $name,
        public readonly array $parameters,
        public readonly bool $strict,
        public readonly string $type,
        public readonly ?string $description = null,
    ) {}

    /**
     * @param  array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            parameters: $attributes['parameters'],
            strict: $attributes['strict'],
            type: $attributes['type'],
            description: $attributes['description'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parameters' => $this->parameters,
            'strict' => $this->strict,
            'type' => $this->type,
            'description' => $this->description,
        ];
    }
}
