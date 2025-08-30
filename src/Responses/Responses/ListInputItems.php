<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Input\ComputerToolCallOutput;
use OpenAI\Responses\Responses\Input\FunctionToolCallOutput;
use OpenAI\Responses\Responses\Input\InputMessage;
use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;
use OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;
use OpenAI\Responses\Responses\Output\OutputMcpCall;
use OpenAI\Responses\Responses\Output\OutputMcpListTools;
use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type InputMessageType from InputMessage
 * @phpstan-import-type OutputMessageType from OutputMessage
 * @phpstan-import-type OutputFileSearchToolCallType from OutputFileSearchToolCall
 * @phpstan-import-type OutputComputerToolCallType from OutputComputerToolCall
 * @phpstan-import-type ComputerToolCallOutputType from ComputerToolCallOutput
 * @phpstan-import-type OutputWebSearchToolCallType from OutputWebSearchToolCall
 * @phpstan-import-type OutputFunctionToolCallType from OutputFunctionToolCall
 * @phpstan-import-type FunctionToolCallOutputType from FunctionToolCallOutput
 * @phpstan-import-type OutputReasoningType from OutputReasoning
 * @phpstan-import-type OutputMcpListToolsType from OutputMcpListTools
 * @phpstan-import-type OutputMcpApprovalRequestType from OutputMcpApprovalRequest
 * @phpstan-import-type OutputMcpCallType from OutputMcpCall
 * @phpstan-import-type OutputImageGenerationToolCallType from OutputImageGenerationToolCall
 * @phpstan-import-type OutputCodeInterpreterToolCallType from OutputCodeInterpreterToolCall
 *
 * @phpstan-type ListInputItemsType array{data: array<int, InputMessageType|OutputMessageType|OutputFileSearchToolCallType|OutputComputerToolCallType|ComputerToolCallOutputType|OutputWebSearchToolCallType|OutputFunctionToolCallType|FunctionToolCallOutputType|OutputReasoningType|OutputMcpListToolsType|OutputMcpApprovalRequestType|OutputMcpCallType|OutputImageGenerationToolCallType|OutputCodeInterpreterToolCallType>, first_id: string, has_more: bool, last_id: string, object: 'list'}
 *
 * @implements ResponseContract<ListInputItemsType>
 */
final class ListInputItems implements ResponseContract, ResponseHasMetaInformationContract
{
    /** @use ArrayAccessible<ListInputItemsType> */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, InputMessage|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall>  $data
     * @param  'list'  $object
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly string $firstId,
        public readonly string $lastId,
        public readonly bool $hasMore,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ListInputItemsType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(
            fn (array $item): InputMessage|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall => match ($item['type']) {
                'message' => $item['role'] === 'assistant' ? OutputMessage::from($item) : InputMessage::from($item),
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
            },
            $attributes['data'],
        );

        return new self(
            object: $attributes['object'],
            data: $data,
            firstId: $attributes['first_id'],
            lastId: $attributes['last_id'],
            hasMore: $attributes['has_more'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                fn (InputMessage|OutputMessage|OutputFileSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|OutputWebSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall $item): array => $item->toArray(),
                $this->data,
            ),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
