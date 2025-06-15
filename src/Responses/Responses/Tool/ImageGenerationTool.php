<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type InputImageMaskType from ImageGenerationInputImageMask
 *
 * @phpstan-type ImageGenerationToolType array{type: 'image_generation', background: 'transparent'|'opaque'|'auto', input_image_mask: InputImageMaskType|null, model?: ?string, moderation: string, output_compression: integer, output_format: 'png'|'webp'|'jpeg', partial_images: ?int, quality: 'low'|'medium'|'high'|'auto', size: '1024x1024'|'1024x1536'|'1536x1024'|'auto'}
 *
 * @implements ResponseContract<ImageGenerationToolType>
 */
final class ImageGenerationTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<ImageGenerationToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'image_generation'  $type
     * @param  'transparent'|'opaque'|'auto'  $background
     * @param  'jpeg'|'png'|'webp'  $outputFormat
     * @param  'low'|'medium'|'high'|'auto'  $quality
     * @param  "1024x1024"|"1024x1536"|"1536x1024"|'auto'  $size
     */
    private function __construct(
        public readonly string $type,
        public readonly string $background,
        public readonly ?ImageGenerationInputImageMask $inputImageMask,
        public readonly ?string $model,
        public readonly string $moderation,
        public readonly int $outputCompression,
        public readonly string $outputFormat,
        public readonly int $partialImages,
        public readonly string $quality,
        public readonly string $size,
    ) {}

    /**
     * @param  ImageGenerationToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            background: $attributes['background'],
            inputImageMask: isset($attributes['input_image_mask'])
                ? ImageGenerationInputImageMask::from($attributes['input_image_mask'])
                : null,
            model: $attributes['model'] ?? null,
            moderation: $attributes['moderation'],
            outputCompression: $attributes['output_compression'],
            outputFormat: $attributes['output_format'],
            partialImages: $attributes['partial_images'] ?? 0,
            quality: $attributes['quality'],
            size: $attributes['size'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'background' => $this->background,
            'input_image_mask' => $this->inputImageMask?->toArray(),
            'model' => $this->model,
            'moderation' => $this->moderation,
            'output_compression' => $this->outputCompression,
            'output_format' => $this->outputFormat,
            'partial_images' => $this->partialImages,
            'quality' => $this->quality,
            'size' => $this->size,
        ];
    }
}
