<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\ToolChoice\AllowedToolsToolChoice;
use OpenAI\Responses\Responses\ToolChoice\CustomToolChoice;
use OpenAI\Responses\Responses\ToolChoice\FunctionToolChoice;
use OpenAI\Responses\Responses\ToolChoice\HostedToolChoice;
use OpenAI\Responses\Responses\ToolChoice\McpToolChoice;

/**
 * @phpstan-import-type AllowedToolsToolChoiceType from AllowedToolsToolChoice
 * @phpstan-import-type CustomToolChoiceType from CustomToolChoice
 * @phpstan-import-type FunctionToolChoiceType from FunctionToolChoice
 * @phpstan-import-type HostedToolChoiceType from HostedToolChoice
 * @phpstan-import-type McpToolChoiceType from McpToolChoice
 *
 * @phpstan-type ResponseToolChoiceTypes 'none'|'auto'|'required'|AllowedToolsToolChoiceType|CustomToolChoiceType|FunctionToolChoiceType|HostedToolChoiceType|McpToolChoiceType
 * @phpstan-type ResponseToolChoiceReturnType 'none'|'auto'|'required'|AllowedToolsToolChoice|CustomToolChoice|FunctionToolChoice|HostedToolChoice|McpToolChoice
 */
final class ToolChoiceObjects
{
    /**
     * @param  ResponseToolChoiceTypes  $toolChoice
     * @return ResponseToolChoiceReturnType
     */
    public static function parse(array|string $toolChoice): string|AllowedToolsToolChoice|CustomToolChoice|FunctionToolChoice|HostedToolChoice|McpToolChoice
    {
        return is_array($toolChoice)
            ? match ($toolChoice['type']) {
                'shell', 'apply_patch', 'file_search', 'web_search', 'web_search_preview', 'web_search_preview_2025_03_11', 'computer', 'computer_use', 'computer_use_preview', 'code_interpreter', 'image_generation', 'programmatic_tool_calling' => HostedToolChoice::from($toolChoice),
                'function' => FunctionToolChoice::from($toolChoice),
                'custom' => CustomToolChoice::from($toolChoice),
                'mcp' => McpToolChoice::from($toolChoice),
                'allowed_tools' => AllowedToolsToolChoice::from($toolChoice),
            }
        : $toolChoice;
    }
}
