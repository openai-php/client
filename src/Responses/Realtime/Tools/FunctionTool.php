<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime\Tools;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type FunctionToolType array{description: string, name: string, parameters: array<string, mixed>, type: 'function'}
 *
 * @implements ResponseContract<FunctionToolType>
 */
final class FunctionTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<FunctionToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $parameters
     * @param  'function'  $type
     */
    private function __construct(
        public readonly string $description,
        public readonly string $name,
        public readonly array $parameters,
        public readonly string $type,
    ) {}

    /**
     * @param  FunctionToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            description: $attributes['description'],
            name: $attributes['name'],
            parameters: $attributes['parameters'],
            type: $attributes['type'],
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
            'type' => $this->type,
        ];
    }
}
