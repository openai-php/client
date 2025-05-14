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
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputMessage;
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
 *
 * @phpstan-type ListInputItemsType array{data: array<int, InputMessageType|OutputMessageType|OutputFileSearchToolCallType|OutputComputerToolCallType|ComputerToolCallOutputType|OutputWebSearchToolCallType|OutputFunctionToolCallType|FunctionToolCallOutputType>, first_id: string, has_more: bool, last_id: string, object: 'list'}
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
     * @param  array<int, InputMessage|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput>  $data
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
            fn (array $item): InputMessage|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput => match ($item['type']) {
                'message' => $item['role'] === 'assistant' ? OutputMessage::from($item) : InputMessage::from($item),
                'file_search_call' => OutputFileSearchToolCall::from($item),
                'function_call' => OutputFunctionToolCall::from($item),
                'function_call_output' => FunctionToolCallOutput::from($item),
                'web_search_call' => OutputWebSearchToolCall::from($item),
                'computer_call' => OutputComputerToolCall::from($item),
                'computer_call_output' => ComputerToolCallOutput::from($item),
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
                fn (InputMessage|OutputMessage|OutputFileSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputWebSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput $item): array => $item->toArray(),
                $this->data,
            ),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
