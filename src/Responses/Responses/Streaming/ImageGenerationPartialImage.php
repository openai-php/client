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
 * @phpstan-type ImageGenerationPartialImageType array{output_index: int, item_id: string, sequence_number: int, partial_image_index: int, partial_image_b64: string}
 *
 * @implements ResponseContract<ImageGenerationPartialImageType>
 */
final class ImageGenerationPartialImage implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ImageGenerationPartialImageType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly int $outputIndex,
        public readonly string $itemId,
        public readonly int $sequenceNumber,
        public readonly int $partialImageIndex,
        public readonly string $partialImageB64,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ImageGenerationPartialImageType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            outputIndex: $attributes['output_index'],
            itemId: $attributes['item_id'],
            sequenceNumber: $attributes['sequence_number'],
            partialImageIndex: $attributes['partial_image_index'],
            partialImageB64: $attributes['partial_image_b64'],
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
            'partial_image_index' => $this->partialImageIndex,
            'partial_image_b64' => $this->partialImageB64,
        ];
    }
}
