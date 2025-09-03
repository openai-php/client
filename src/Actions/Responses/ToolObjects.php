<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\Tool\CodeInterpreterTool;
use OpenAI\Responses\Responses\Tool\ComputerUseTool;
use OpenAI\Responses\Responses\Tool\FileSearchTool;
use OpenAI\Responses\Responses\Tool\FunctionTool;
use OpenAI\Responses\Responses\Tool\ImageGenerationTool;
use OpenAI\Responses\Responses\Tool\RemoteMcpTool;
use OpenAI\Responses\Responses\Tool\WebSearchTool;

/**
 * @phpstan-import-type ComputerUseToolType from ComputerUseTool
 * @phpstan-import-type FileSearchToolType from FileSearchTool
 * @phpstan-import-type ImageGenerationToolType from ImageGenerationTool
 * @phpstan-import-type RemoteMcpToolType from RemoteMcpTool
 * @phpstan-import-type FunctionToolType from FunctionTool
 * @phpstan-import-type WebSearchToolType from WebSearchTool
 * @phpstan-import-type CodeInterpreterToolType from CodeInterpreterTool
 *
 * @phpstan-type ResponseToolObjectTypes array<int, ComputerUseToolType|FileSearchToolType|FunctionToolType|WebSearchToolType|ImageGenerationToolType|RemoteMcpToolType|CodeInterpreterToolType>
 * @phpstan-type ResponseToolObjectReturnType array<int, ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool|ImageGenerationTool|RemoteMcpTool|CodeInterpreterTool>
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
            fn (array $tool): ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool|ImageGenerationTool|RemoteMcpTool|CodeInterpreterTool => match ($tool['type']) {
                'file_search' => FileSearchTool::from($tool),
                'web_search', 'web_search_preview', 'web_search_preview_2025_03_11' => WebSearchTool::from($tool),
                'function' => FunctionTool::from($tool),
                'computer_use_preview' => ComputerUseTool::from($tool),
                'image_generation' => ImageGenerationTool::from($tool),
                'mcp' => RemoteMcpTool::from($tool),
                'code_interpreter' => CodeInterpreterTool::from($tool),
            },
            $toolItems,
        );
    }
}
