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
 * @phpstan-type ImageGenerationPartType array{output_index: int, item_id: string, sequence_number: int}
 *
 * @implements ResponseContract<ImageGenerationPartType>
 */
final class ImageGenerationPart implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ImageGenerationPartType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly int $outputIndex,
        public readonly string $itemId,
        public readonly int $sequenceNumber,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ImageGenerationPartType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            outputIndex: $attributes['output_index'],
            itemId: $attributes['item_id'],
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
            'output_index' => $this->outputIndex,
            'item_id' => $this->itemId,
            'sequence_number' => $this->sequenceNumber,
        ];
    }
}
