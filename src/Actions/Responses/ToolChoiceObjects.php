<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\ToolChoice\FunctionToolChoice;
use OpenAI\Responses\Responses\ToolChoice\HostedToolChoice;

/**
 * @phpstan-import-type FunctionToolChoiceType from FunctionToolChoice
 * @phpstan-import-type HostedToolChoiceType from HostedToolChoice
 *
 * @phpstan-type ResponseToolChoiceTypes 'none'|'auto'|'required'|FunctionToolChoiceType|HostedToolChoiceType
 * @phpstan-type ResponseToolChoiceReturnType 'none'|'auto'|'required'|FunctionToolChoice|HostedToolChoice
 */
final class ToolChoiceObjects
{
    /**
     * @param  ResponseToolChoiceTypes  $toolChoice
     * @return ResponseToolChoiceReturnType
     */
    public static function parse(array|string $toolChoice): string|FunctionToolChoice|HostedToolChoice
    {
        return is_array($toolChoice)
            ? match ($toolChoice['type']) {
                'file_search', 'web_search', 'web_search_preview', 'computer_use_preview' => HostedToolChoice::from($toolChoice),
                'function' => FunctionToolChoice::from($toolChoice),
            }
        : $toolChoice;
    }
}
