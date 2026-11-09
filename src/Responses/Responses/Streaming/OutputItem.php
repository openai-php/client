<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Actions\Responses\OutputObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputApplyPatchToolCall;
use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use OpenAI\Responses\Responses\Output\OutputCompaction;
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
use OpenAI\Responses\Responses\Output\OutputProgram;
use OpenAI\Responses\Responses\Output\OutputProgramOutput;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputShellCall;
use OpenAI\Responses\Responses\Output\OutputShellCallOutput;
use OpenAI\Responses\Responses\Output\OutputToolSearchCall;
use OpenAI\Responses\Responses\Output\OutputToolSearchOutput;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputApplyPatchToolCallType from OutputApplyPatchToolCall
 * @phpstan-import-type OutputShellCallType from OutputShellCall
 * @phpstan-import-type OutputShellCallOutputType from OutputShellCallOutput
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
 * @phpstan-import-type OutputLocalShellCallType from OutputLocalShellCall
 * @phpstan-import-type OutputCustomToolCallType from OutputCustomToolCall
 *
 * @phpstan-type OutputItemType array{type: string, output_index: int, sequence_number: int, item: OutputApplyPatchToolCallType|OutputShellCallType|OutputShellCallOutputType|OutputCodeInterpreterToolCallType|OutputComputerToolCallType|OutputFileSearchToolCallType|OutputFunctionToolCallType|OutputMessageType|OutputProgramType|OutputProgramOutputType|OutputReasoningType|OutputWebSearchToolCallType|OutputMcpListToolsType|OutputMcpApprovalRequestType|OutputMcpCallType|OutputImageGenerationToolCallType|OutputCompactionType|OutputToolSearchCallType|OutputToolSearchOutputType|OutputLocalShellCallType|OutputCustomToolCallType}
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
        public readonly OutputApplyPatchToolCall|OutputShellCall|OutputShellCallOutput|OutputMessage|OutputCodeInterpreterToolCall|OutputFileSearchToolCall|OutputFunctionToolCall|OutputProgram|OutputProgramOutput|OutputWebSearchToolCall|OutputComputerToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCompaction|OutputToolSearchCall|OutputToolSearchOutput|OutputLocalShellCall|OutputCustomToolCall $item,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  OutputItemType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $item = OutputObjects::parse([$attributes['item']])[0];

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
