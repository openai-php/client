<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ToolSearchToolType array{type: 'tool_search', description?: ?string, execution?: null|'server'|'client', parameters: mixed}
 *
 * @implements ResponseContract<ToolSearchToolType>
 */
final class ToolSearchTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<ToolSearchToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'tool_search'  $type
     * @param  'server'|'client'|null  $execution
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $description,
        public readonly ?string $execution,
        public readonly mixed $parameters
    ) {}

    /**
     * @param  ToolSearchToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            description: $attributes['description'] ?? null,
            execution: $attributes['execution'] ?? null,
            parameters: $attributes['parameters'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'description' => $this->description,
            'execution' => $this->execution,
            'parameters' => $this->parameters,
        ];
    }
}
