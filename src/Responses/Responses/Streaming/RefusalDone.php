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
 * @phpstan-type RefusalDoneType array{type: string, content_index: int, item_id: string, output_index: int, refusal: string, sequence_number?: int}
 *
 * @implements ResponseContract<RefusalDoneType>
 */
final class RefusalDone implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<RefusalDoneType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly int $contentIndex,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly string $refusal,
        public readonly ?int $sequenceNumber,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  RefusalDoneType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            contentIndex: $attributes['content_index'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            refusal: $attributes['refusal'],
            sequenceNumber: $attributes['sequence_number'] ?? null,
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $attributes = [
            'type' => $this->type,
            'content_index' => $this->contentIndex,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
            'refusal' => $this->refusal,
        ];

        if ($this->sequenceNumber !== null) {
            $attributes['sequence_number'] = $this->sequenceNumber;
        }

        return $attributes;
    }
}
