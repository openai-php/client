<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputCustomToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;
use OpenAI\Responses\Responses\Output\OutputLocalShellCall;
use OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;
use OpenAI\Responses\Responses\Output\OutputMcpCall;
use OpenAI\Responses\Responses\Output\OutputMcpListTools;
use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;

/**
 * @phpstan-import-type OutputComputerToolCallType from OutputComputerToolCall
 * @phpstan-import-type OutputFileSearchToolCallType from OutputFileSearchToolCall
 * @phpstan-import-type OutputFunctionToolCallType from OutputFunctionToolCall
 * @phpstan-import-type OutputMessageType from OutputMessage
 * @phpstan-import-type OutputReasoningType from OutputReasoning
 * @phpstan-import-type OutputWebSearchToolCallType from OutputWebSearchToolCall
 * @phpstan-import-type OutputMcpListToolsType from OutputMcpListTools
 * @phpstan-import-type OutputMcpApprovalRequestType from OutputMcpApprovalRequest
 * @phpstan-import-type OutputMcpCallType from OutputMcpCall
 * @phpstan-import-type OutputImageGenerationToolCallType from OutputImageGenerationToolCall
 * @phpstan-import-type OutputCodeInterpreterToolCallType from OutputCodeInterpreterToolCall
 * @phpstan-import-type OutputLocalShellCallType from OutputLocalShellCall
 * @phpstan-import-type OutputCustomToolCallType from OutputCustomToolCall
 *
 * @phpstan-type ResponseOutputObjectTypes array<int, OutputComputerToolCallType|OutputFileSearchToolCallType|OutputFunctionToolCallType|OutputMessageType|OutputReasoningType|OutputWebSearchToolCallType|OutputMcpListToolsType|OutputMcpApprovalRequestType|OutputMcpCallType|OutputImageGenerationToolCallType|OutputCodeInterpreterToolCallType|OutputLocalShellCallType|OutputCustomToolCallType>
 * @phpstan-type ResponseOutputObjectReturnType array<int, OutputMessage|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall>
 */
final class OutputObjects
{
    /**
     * @param  ResponseOutputObjectTypes  $outputItems
     * @return ResponseOutputObjectReturnType
     */
    public static function parse(array $outputItems): array
    {
        return array_map(
            fn (array $item): OutputMessage|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall => match ($item['type']) {
                'message' => OutputMessage::from($item),
                'file_search_call' => OutputFileSearchToolCall::from($item),
                'function_call' => OutputFunctionToolCall::from($item),
                'web_search_call' => OutputWebSearchToolCall::from($item),
                'computer_call' => OutputComputerToolCall::from($item),
                'reasoning' => OutputReasoning::from($item),
                'mcp_list_tools' => OutputMcpListTools::from($item),
                'mcp_approval_request' => OutputMcpApprovalRequest::from($item),
                'mcp_call' => OutputMcpCall::from($item),
                'image_generation_call' => OutputImageGenerationToolCall::from($item),
                'code_interpreter_call' => OutputCodeInterpreterToolCall::from($item),
                'local_shell_call' => OutputLocalShellCall::from($item),
                'custom_tool_call' => OutputCustomToolCall::from($item),
            },
            $outputItems,
        );
    }
}
