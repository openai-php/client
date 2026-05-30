<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

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

/**
 * @phpstan-type ResponseToolObjectTypes array<int, array{type: string}>
 * @phpstan-type ResponseToolObjectReturnType array<int, ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool|ImageGenerationTool|RemoteMcpTool|CodeInterpreterTool|ToolSearchTool|NamespaceTool|CustomTool>
 */
final class ToolObjects
{
    /**
     * @param  ResponseToolObjectTypes  $toolItems
     * @return ResponseToolObjectReturnType
     */
    public static function parse(array $toolItems): array
    {
        return array_map(
            fn (array $tool): ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool|ImageGenerationTool|RemoteMcpTool|CodeInterpreterTool|ToolSearchTool|NamespaceTool|CustomTool => match ($tool['type']) {
                'file_search' => FileSearchTool::from($tool), // @phpstan-ignore-line
                'web_search', 'web_search_preview', 'web_search_preview_2025_03_11' => WebSearchTool::from($tool), // @phpstan-ignore-line
                'function' => FunctionTool::from($tool), // @phpstan-ignore-line
                'computer_use_preview' => ComputerUseTool::from($tool), // @phpstan-ignore-line
                'image_generation' => ImageGenerationTool::from($tool), // @phpstan-ignore-line
                'mcp' => RemoteMcpTool::from($tool), // @phpstan-ignore-line
                'code_interpreter' => CodeInterpreterTool::from($tool), // @phpstan-ignore-line
                'tool_search' => ToolSearchTool::from($tool), // @phpstan-ignore-line
                'namespace' => NamespaceTool::from($tool), // @phpstan-ignore-line
                'custom' => CustomTool::from($tool), // @phpstan-ignore-line
                default => throw new \InvalidArgumentException("Unknown tool type: {$tool['type']}"),
            },
            $toolItems,
        );
    }
}
