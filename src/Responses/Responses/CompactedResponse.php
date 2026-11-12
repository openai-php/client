<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Actions\Responses\ItemObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Input\ApplyPatchToolCallOutput;
use OpenAI\Responses\Responses\Input\ComputerToolCallOutput;
use OpenAI\Responses\Responses\Input\CustomToolCallOutput;
use OpenAI\Responses\Responses\Input\FunctionToolCallOutput;
use OpenAI\Responses\Responses\Input\InputMessage;
use OpenAI\Responses\Responses\Input\LocalShellCallOutput;
use OpenAI\Responses\Responses\Input\McpApprovalResponse;
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
 * @phpstan-import-type ResponseItemObjectTypes from ItemObjects
 * @phpstan-import-type UsageType from CreateResponseUsage
 *
 * @phpstan-type CompactedResponseType array{id: string, object: 'response.compaction', created_at: int, output: ResponseItemObjectTypes, usage: UsageType}
 *
 * @implements ResponseContract<CompactedResponseType>
 */
final class CompactedResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<CompactedResponseType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'response.compaction'  $object
     * @param  array<int, ApplyPatchToolCallOutput|InputMessage|OutputApplyPatchToolCall|OutputShellCall|OutputShellCallOutput|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|LocalShellCallOutput|McpApprovalResponse|CustomToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall|OutputProgram|OutputProgramOutput|OutputToolSearchCall|OutputToolSearchOutput|OutputCompaction>  $output
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly array $output,
        public readonly CreateResponseUsage $usage,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  CompactedResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        // The compacted output holds the user messages, as input items, and a compaction item.
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            output: ItemObjects::parse($attributes['output']),
            usage: CreateResponseUsage::from($attributes['usage']),
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'output' => array_map(
                fn (ApplyPatchToolCallOutput|InputMessage|OutputApplyPatchToolCall|OutputShellCall|OutputShellCallOutput|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|LocalShellCallOutput|McpApprovalResponse|CustomToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall|OutputProgram|OutputProgramOutput|OutputToolSearchCall|OutputToolSearchOutput|OutputCompaction $item): array => $item->toArray(),
                $this->output,
            ),
            'usage' => $this->usage->toArray(),
        ];
    }
}
