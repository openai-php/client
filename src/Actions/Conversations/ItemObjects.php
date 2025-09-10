<?php

declare(strict_types=1);

namespace OpenAI\Actions\Conversations;

use OpenAI\Responses\Conversations\Objects\Message;
use OpenAI\Responses\Responses\Input\ComputerToolCallOutput;
use OpenAI\Responses\Responses\Input\CustomToolCallOutput;
use OpenAI\Responses\Responses\Input\FunctionToolCallOutput;
use OpenAI\Responses\Responses\Input\LocalShellCallOutput;
use OpenAI\Responses\Responses\Input\McpApprovalResponse;
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
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;

/**
 * @phpstan-import-type MessageType from Message
 * @phpstan-import-type ComputerToolCallOutputType from ComputerToolCallOutput
 * @phpstan-import-type FunctionToolCallOutputType from FunctionToolCallOutput
 * @phpstan-import-type LocalShellCallOutputType from LocalShellCallOutput
 * @phpstan-import-type McpApprovalResponseType from McpApprovalResponse
 * @phpstan-import-type CustomToolCallOutputType from CustomToolCallOutput
 * @phpstan-import-type OutputComputerToolCallType from OutputComputerToolCall
 * @phpstan-import-type OutputFileSearchToolCallType from OutputFileSearchToolCall
 * @phpstan-import-type OutputFunctionToolCallType from OutputFunctionToolCall
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
 * @phpstan-type ItemObjectTypes MessageType|ComputerToolCallOutputType|FunctionToolCallOutputType|LocalShellCallOutputType|McpApprovalResponseType|CustomToolCallOutputType|OutputComputerToolCallType|OutputFileSearchToolCallType|OutputFunctionToolCallType|OutputReasoningType|OutputWebSearchToolCallType|OutputMcpListToolsType|OutputMcpApprovalRequestType|OutputMcpCallType|OutputImageGenerationToolCallType|OutputCodeInterpreterToolCallType|OutputLocalShellCallType|OutputCustomToolCallType
 * @phpstan-type ConversationItemObjectTypes array<int, ItemObjectTypes>
 * @phpstan-type ConversationItemObjectReturnType array<int, Message|ComputerToolCallOutput|FunctionToolCallOutput|LocalShellCallOutput|McpApprovalResponse|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall|CustomToolCallOutput>
 */
final class ItemObjects
{
    /**
     * @param  ConversationItemObjectTypes  $outputItems
     * @return ConversationItemObjectReturnType
     */
    public static function parse(array $outputItems): array
    {
        return array_map(
            fn (array $item): Message|ComputerToolCallOutput|FunctionToolCallOutput|LocalShellCallOutput|McpApprovalResponse|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall|CustomToolCallOutput => match ($item['type']) {
                'message' => Message::from($item),
                'file_search_call' => OutputFileSearchToolCall::from($item),
                'function_call' => OutputFunctionToolCall::from($item),
                'function_call_output' => FunctionToolCallOutput::from($item),
                'web_search_call' => OutputWebSearchToolCall::from($item),
                'computer_call' => OutputComputerToolCall::from($item),
                'computer_call_output' => ComputerToolCallOutput::from($item),
                'reasoning' => OutputReasoning::from($item),
                'mcp_list_tools' => OutputMcpListTools::from($item),
                'mcp_approval_request' => OutputMcpApprovalRequest::from($item),
                'mcp_call' => OutputMcpCall::from($item),
                'image_generation_call' => OutputImageGenerationToolCall::from($item),
                'code_interpreter_call' => OutputCodeInterpreterToolCall::from($item),
                'local_shell_call' => OutputLocalShellCall::from($item),
                'custom_tool_call' => OutputCustomToolCall::from($item),
                'local_shell_call_output' => LocalShellCallOutput::from($item),
                'custom_tool_call_output' => CustomToolCallOutput::from($item),
                'mcp_approval_response' => McpApprovalResponse::from($item),
            },
            $outputItems,
        );
    }
}
