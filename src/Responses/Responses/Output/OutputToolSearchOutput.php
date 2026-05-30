<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Actions\Responses\ToolObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Tool\CodeInterpreterTool;
use OpenAI\Responses\Responses\Tool\ComputerUseTool;
use OpenAI\Responses\Responses\Tool\CustomTool;
use OpenAI\Responses\Responses\Tool\FileSearchTool;
use OpenAI\Responses\Responses\Tool\FunctionTool;
use OpenAI\Responses\Responses\Tool\ImageGenerationTool;
use OpenAI\Responses\Responses\Tool\NamespaceTool;
use OpenAI\Responses\Responses\Tool\RemoteMcpTool;
use OpenAI\Responses\Responses\Tool\ToolSearchTool;
use OpenAI\Responses\Responses\Tool\WebSearchTool;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ResponseToolObjectTypes from ToolObjects
 * @phpstan-import-type ResponseToolObjectReturnType from ToolObjects
 *
 * @phpstan-type OutputToolSearchOutputType array{id: string, call_id: ?string, execution: 'server'|'client', status: 'in_progress'|'completed'|'incomplete', tools: ResponseToolObjectTypes, type: 'tool_search_output', created_by?: ?string}
 *
 * @implements ResponseContract<OutputToolSearchOutputType>
 */
final class OutputToolSearchOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputToolSearchOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'server'|'client'  $execution
     * @param  'in_progress'|'completed'|'incomplete'  $status
     * @param  ResponseToolObjectReturnType  $tools
     * @param  'tool_search_output'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly ?string $callId,
        public readonly string $execution,
        public readonly string $status,
        public readonly array $tools,
        public readonly string $type,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputToolSearchOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            callId: $attributes['call_id'] ?? null,
            execution: $attributes['execution'],
            status: $attributes['status'],
            tools: ToolObjects::parse($attributes['tools']),
            type: $attributes['type'],
            createdBy: $attributes['created_by'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'call_id' => $this->callId,
            'execution' => $this->execution,
            'status' => $this->status,
            'tools' => array_map(
                fn (CodeInterpreterTool|ComputerUseTool|CustomTool|FileSearchTool|FunctionTool|ImageGenerationTool|NamespaceTool|RemoteMcpTool|ToolSearchTool|WebSearchTool $tool): array => $tool->toArray(),
                $this->tools,
            ),
            'type' => $this->type,
            'created_by' => $this->createdBy,
        ];
    }
}
