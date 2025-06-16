<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputMcpListToolsToolType from OutputMcpListToolsTool
 *
 * @phpstan-type OutputMcpListToolsType array{id: string, server_label: string, type: 'mcp_list_tools', tools: array<int, OutputMcpListToolsToolType>}
 *
 * @implements ResponseContract<OutputMcpListToolsType>
 */
final class OutputMcpListTools implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputMcpListToolsType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'mcp_list_tools'  $type
     * @param  array<int, OutputMcpListToolsTool>  $tools
     */
    private function __construct(
        public readonly string $id,
        public readonly string $serverLabel,
        public readonly string $type,
        public readonly array $tools,
    ) {}

    /**
     * @param  OutputMcpListToolsType  $attributes
     */
    public static function from(array $attributes): self
    {
        $tools = array_map(
            fn (array $result): OutputMcpListToolsTool => OutputMcpListToolsTool::from($result),
            $attributes['tools']
        );

        return new self(
            id: $attributes['id'],
            serverLabel: $attributes['server_label'],
            type: $attributes['type'],
            tools: $tools,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'server_label' => $this->serverLabel,
            'type' => $this->type,
            'tools' => array_map(
                fn (OutputMcpListToolsTool $tool) => $tool->toArray(),
                $this->tools
            ),
        ];
    }
}
