<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;
use OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;
use OpenAI\Responses\Responses\Output\OutputMcpCall;
use OpenAI\Responses\Responses\Output\OutputMcpListTools;
use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputText;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;

/**
 * An SDK-only property (output_text) that concatenates all text content from output messages.
 *
 * @phpstan-type ResponseOutputTextTypes array<int, OutputMessage|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall>
 */
final class OutputText
{
    /**
     * @param  ResponseOutputTextTypes  $outputItems
     */
    public static function parse(array $outputItems): ?string
    {
        $texts = [];
        foreach ($outputItems as $item) {
            if ($item instanceof OutputMessage) {
                foreach ($item->content as $content) {
                    if ($content instanceof OutputMessageContentOutputText) {
                        $texts[] = $content->text;
                    }
                }
            }
        }

        return empty($texts) ? null : implode(' ', $texts);
    }
}
