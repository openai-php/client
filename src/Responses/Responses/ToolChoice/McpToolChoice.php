<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\ToolChoice;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type McpToolChoiceType array{server_label: string, type: 'mcp', name?: string|null}
 *
 * @implements ResponseContract<McpToolChoiceType>
 */
final class McpToolChoice implements ResponseContract
{
    /**
     * @use ArrayAccessible<McpToolChoiceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'mcp'  $type
     */
    private function __construct(
        public readonly string $serverLabel,
        public readonly string $type,
        public readonly ?string $name,
    ) {}

    /**
     * @param  McpToolChoiceType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            serverLabel: $attributes['server_label'],
            type: $attributes['type'],
            name: $attributes['name'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'server_label' => $this->serverLabel,
            'type' => $this->type,
            'name' => $this->name,
        ];
    }
}
