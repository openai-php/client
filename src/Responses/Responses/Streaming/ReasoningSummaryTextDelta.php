<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ReasoningSummaryTextDeltaType array{delta: string, item_id: string, output_index: int, summary_index: int}
 *
 * @implements ResponseContract<ReasoningSummaryTextDeltaType>
 */
final class ReasoningSummaryTextDelta implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ReasoningSummaryTextDeltaType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $delta,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly int $summaryIndex,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ReasoningSummaryTextDeltaType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            delta: $attributes['delta'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            summaryIndex: $attributes['summary_index'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'delta' => $this->delta,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
            'summary_index' => $this->summaryIndex,
        ];
    }
}
