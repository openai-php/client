<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputComputerToolCallType from OutputComputerToolCall
 * @phpstan-import-type OutputFileSearchToolCallType from OutputFileSearchToolCall
 * @phpstan-import-type OutputFunctionToolCallType from OutputFunctionToolCall
 * @phpstan-import-type OutputMessageType from OutputMessage
 * @phpstan-import-type OutputReasoningType from OutputReasoning
 * @phpstan-import-type OutputWebSearchToolCallType from OutputWebSearchToolCall
 *
 * @phpstan-type OutputItemType array{item: OutputComputerToolCallType|OutputFileSearchToolCallType|OutputFunctionToolCallType|OutputMessageType|OutputReasoningType|OutputWebSearchToolCallType, output_index: int}
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
        public readonly int $outputIndex,
        public readonly OutputMessage|OutputFileSearchToolCall|OutputFunctionToolCall|OutputWebSearchToolCall|OutputComputerToolCall|OutputReasoning $item,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  OutputItemType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $item = match ($attributes['item']['type']) {
            'message' => OutputMessage::from($attributes['item']),
            'file_search_call' => OutputFileSearchToolCall::from($attributes['item']),
            'function_call' => OutputFunctionToolCall::from($attributes['item']),
            'web_search_call' => OutputWebSearchToolCall::from($attributes['item']),
            'computer_call' => OutputComputerToolCall::from($attributes['item']),
            'reasoning' => OutputReasoning::from($attributes['item']),
        };

        return new self(
            outputIndex: $attributes['output_index'],
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
            'output_index' => $this->outputIndex,
            'item' => $this->item->toArray(),
        ];
    }
}
