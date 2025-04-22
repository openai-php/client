<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Format;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{name: string, schema: array<string, mixed>, type: 'json_schema', description: ?string, strict: ?bool}>
 */
final class JsonSchemaFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{name: string, schema: array<string, mixed>, type: 'json_schema', description: ?string, strict: ?bool}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $schema
     * @param  'json_schema'  $type
     */
    private function __construct(
        public readonly string $name,
        public readonly array $schema,
        public readonly string $type,
        public readonly ?string $description,
        public readonly ?bool $strict = null,
    ) {}

    /**
     * @param  array{name: string, schema: array<string, mixed>, type: 'json_schema', description: ?string, strict: ?bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            schema: $attributes['schema'],
            type: $attributes['type'],
            description: $attributes['description'] ?? null,
            strict: $attributes['strict'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'schema' => $this->schema,
            'type' => $this->type,
            'description' => $this->description,
            'strict' => $this->strict,
        ];
    }
}
