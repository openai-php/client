<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type FunctionToolType array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string, allowed_callers?: array<int, 'direct'|'programmatic'>|null, output_schema?: array<string, mixed>|null}
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
     * @param  array<int, 'direct'|'programmatic'>|null  $allowedCallers
     * @param  array<string, mixed>|null  $outputSchema
     */
    private function __construct(
        public readonly string $name,
        public readonly array $parameters,
        public readonly bool $strict,
        public readonly string $type,
        public readonly ?string $description = null,
        public readonly ?array $allowedCallers = null,
        public readonly ?array $outputSchema = null,
    ) {}

    /**
     * @param  FunctionToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            parameters: $attributes['parameters'],
            strict: $attributes['strict'],
            type: $attributes['type'],
            description: $attributes['description'] ?? null,
            allowedCallers: $attributes['allowed_callers'] ?? null,
            outputSchema: $attributes['output_schema'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $attributes = [
            'name' => $this->name,
            'parameters' => $this->parameters,
            'strict' => $this->strict,
            'type' => $this->type,
            'description' => $this->description,
        ];

        if ($this->allowedCallers !== null) {
            $attributes['allowed_callers'] = $this->allowedCallers;
        }

        if ($this->outputSchema !== null) {
            $attributes['output_schema'] = $this->outputSchema;
        }

        return $attributes;
    }
}
