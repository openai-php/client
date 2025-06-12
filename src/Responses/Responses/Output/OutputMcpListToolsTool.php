<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputMcpListToolsToolType array{annotations: array<string, string>|null, description: ?string, input_schema: array<string, string>, name: string}
 *
 * @implements ResponseContract<OutputMcpListToolsToolType>
 */
final class OutputMcpListToolsTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputMcpListToolsToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, string>  $inputSchema
     * @param  array<string, string>|null  $annotations
     */
    private function __construct(
        public readonly string $name,
        public readonly array $inputSchema,
        public readonly ?string $description = null,
        public readonly ?array $annotations = null,
    ) {}

    /**
     * @param  OutputMcpListToolsToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            inputSchema: $attributes['input_schema'],
            description: $attributes['description'] ?? null,
            annotations: $attributes['annotations'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'input_schema' => $this->inputSchema,
            'description' => $this->description,
            'annotations' => $this->annotations,
        ];
    }
}
