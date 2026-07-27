<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use OpenAI\Responses\Responses\Output\OutputCompaction;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;
use OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;
use OpenAI\Responses\Responses\Output\OutputMcpCall;
use OpenAI\Responses\Responses\Output\OutputMcpListTools;
use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputProgram;
use OpenAI\Responses\Responses\Output\OutputProgramOutput;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputToolSearchCall;
use OpenAI\Responses\Responses\Output\OutputToolSearchOutput;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputComputerToolCallType from OutputComputerToolCall
 * @phpstan-import-type OutputFileSearchToolCallType from OutputFileSearchToolCall
 * @phpstan-import-type OutputFunctionToolCallType from OutputFunctionToolCall
 * @phpstan-import-type OutputMessageType from OutputMessage
 * @phpstan-import-type OutputReasoningType from OutputReasoning
 * @phpstan-import-type OutputWebSearchToolCallType from OutputWebSearchToolCall
 * @phpstan-import-type OutputImageGenerationToolCallType from OutputImageGenerationToolCall
 * @phpstan-import-type OutputMcpListToolsType from OutputMcpListTools
 * @phpstan-import-type OutputMcpApprovalRequestType from OutputMcpApprovalRequest
 * @phpstan-import-type OutputMcpCallType from OutputMcpCall
 * @phpstan-import-type OutputCodeInterpreterToolCallType from OutputCodeInterpreterToolCall
 * @phpstan-import-type OutputCompactionType from OutputCompaction
 * @phpstan-import-type OutputProgramType from OutputProgram
 * @phpstan-import-type OutputProgramOutputType from OutputProgramOutput
 * @phpstan-import-type OutputToolSearchCallType from OutputToolSearchCall
 * @phpstan-import-type OutputToolSearchOutputType from OutputToolSearchOutput
 *
 * @phpstan-type OutputItemType array{type: string, output_index: int, sequence_number: int, item: OutputCodeInterpreterToolCallType|OutputComputerToolCallType|OutputFileSearchToolCallType|OutputFunctionToolCallType|OutputMessageType|OutputProgramType|OutputProgramOutputType|OutputReasoningType|OutputWebSearchToolCallType|OutputMcpListToolsType|OutputMcpApprovalRequestType|OutputMcpCallType|OutputImageGenerationToolCallType|OutputCompactionType|OutputToolSearchCallType|OutputToolSearchOutputType}
 *
 * @implements ResponseContract<OutputItemType>
 */
final class OutputItem implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<OutputItemType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly int $outputIndex,
        public readonly int $sequenceNumber,
        public readonly OutputMessage|OutputCodeInterpreterToolCall|OutputFileSearchToolCall|OutputFunctionToolCall|OutputProgram|OutputProgramOutput|OutputWebSearchToolCall|OutputComputerToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCompaction|OutputToolSearchCall|OutputToolSearchOutput $item,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  OutputItemType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        /** @var 'message'|'file_search_call'|'function_call'|'program'|'program_output'|'web_search_call'|'computer_call'|'reasoning'|'image_generation_call'|'mcp_list_tools'|'mcp_approval_request'|'mcp_call'|'code_interpreter_call'|'compaction'|'tool_search_call'|'tool_search_output' $itemType */
        $itemType = $attributes['item']['type'];

        $item = match ($itemType) {
            'message' => OutputMessage::from($attributes['item']),
            'file_search_call' => OutputFileSearchToolCall::from($attributes['item']),
            'function_call' => OutputFunctionToolCall::from($attributes['item']),
            'program' => OutputProgram::from($attributes['item']),
            'program_output' => OutputProgramOutput::from($attributes['item']),
            'web_search_call' => OutputWebSearchToolCall::from($attributes['item']),
            'computer_call' => OutputComputerToolCall::from($attributes['item']),
            'reasoning' => OutputReasoning::from($attributes['item']),
            'image_generation_call' => OutputImageGenerationToolCall::from($attributes['item']),
            'mcp_list_tools' => OutputMcpListTools::from($attributes['item']),
            'mcp_approval_request' => OutputMcpApprovalRequest::from($attributes['item']),
            'mcp_call' => OutputMcpCall::from($attributes['item']),
            'code_interpreter_call' => OutputCodeInterpreterToolCall::from($attributes['item']),
            'compaction' => OutputCompaction::from($attributes['item']),
            'tool_search_call' => OutputToolSearchCall::from($attributes['item']),
            'tool_search_output' => OutputToolSearchOutput::from($attributes['item']),
        };

        return new self(
            type: $attributes['type'],
            outputIndex: $attributes['output_index'],
            sequenceNumber: $attributes['sequence_number'],
            item: $item,
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'output_index' => $this->outputIndex,
            'sequence_number' => $this->sequenceNumber,
            'item' => $this->item->toArray(),
        ];
    }
}
