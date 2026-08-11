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
 * @phpstan-type ApplyPatchCallOperationDiffDoneType array{type: string, diff: string, item_id: string, output_index: int, sequence_number: int}
 *
 * @implements ResponseContract<ApplyPatchCallOperationDiffDoneType>
 */
final class ApplyPatchCallOperationDiffDone implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ApplyPatchCallOperationDiffDoneType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly string $diff,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly int $sequenceNumber,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ApplyPatchCallOperationDiffDoneType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            diff: $attributes['diff'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            sequenceNumber: $attributes['sequence_number'],
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
            'diff' => $this->diff,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
            'sequence_number' => $this->sequenceNumber,
        ];
    }
}
