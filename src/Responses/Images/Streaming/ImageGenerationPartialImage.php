<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ImageGenerationPartialImageType array{type: string, b64_json: string, created_at: int, size: string, quality: string, background: string, output_format: string, partial_image_index: int}
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
        public readonly string $type,
        public readonly string $b64Json,
        public readonly int $createdAt,
        public readonly string $size,
        public readonly string $quality,
        public readonly string $background,
        public readonly string $outputFormat,
        public readonly int $partialImageIndex,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ImageGenerationPartialImageType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            b64Json: $attributes['b64_json'],
            createdAt: $attributes['created_at'],
            size: $attributes['size'],
            quality: $attributes['quality'],
            background: $attributes['background'],
            outputFormat: $attributes['output_format'],
            partialImageIndex: $attributes['partial_image_index'],
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
            'b64_json' => $this->b64Json,
            'created_at' => $this->createdAt,
            'size' => $this->size,
            'quality' => $this->quality,
            'background' => $this->background,
            'output_format' => $this->outputFormat,
            'partial_image_index' => $this->partialImageIndex,
        ];
    }
}
