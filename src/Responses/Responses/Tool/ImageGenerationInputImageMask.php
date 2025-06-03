<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type InputImageMaskType array{file_id: string|null, image_url: string|null}
 *
 * @implements ResponseContract<InputImageMaskType>
 */
final class ImageGenerationInputImageMask implements ResponseContract
{
    /**
     * @use ArrayAccessible<InputImageMaskType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly ?string $fileId,
        public readonly ?string $imageUrl,
    ) {}

    /**
     * @param  InputImageMaskType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            fileId: $attributes['file_id'] ?? null,
            imageUrl: $attributes['image_url'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'file_id' => $this->fileId,
            'image_url' => $this->imageUrl,
        ];
    }
}
