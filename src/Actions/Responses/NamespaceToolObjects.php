<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\Tool\NamespaceTools\CustomTool;
use OpenAI\Responses\Responses\Tool\NamespaceTools\FunctionTool;

/**
 * @phpstan-import-type FunctionToolType from FunctionTool
 * @phpstan-import-type CustomToolType from CustomTool
 *
 * @phpstan-type ResponseNamespaceToolObjectTypes array<int, FunctionToolType|CustomToolType>
 * @phpstan-type ResponseNamespaceToolObjectReturnType array<int, FunctionTool|CustomTool>
 */
final class NamespaceToolObjects
{
    /**
     * @param  ResponseNamespaceToolObjectTypes  $toolItems
     * @return ResponseNamespaceToolObjectReturnType
     */
    public static function parse(array $toolItems): array
    {
        return array_map(
            fn (array $tool): FunctionTool|CustomTool => match ($tool['type']) {
                'function' => FunctionTool::from($tool),
                'custom' => CustomTool::from($tool),
            },
            $toolItems,
        );
    }
}
