<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type FunctionToolCallOutputImageType array{type: 'input_image', detail?: string, file_id?: string, image_url?: string}
 *
 * @implements ResponseContract<FunctionToolCallOutputImageType>
 */
final class FunctionToolCallOutputImage implements ResponseContract
{
    /**
     * @use ArrayAccessible<FunctionToolCallOutputImageType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'input_image'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $detail,
        public readonly ?string $fileId,
        public readonly ?string $imageUrl,
    ) {}

    /**
     * @param  FunctionToolCallOutputImageType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            detail: $attributes['detail'] ?? null,
            fileId: $attributes['file_id'] ?? null,
            imageUrl: $attributes['image_url'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'detail' => $this->detail,
            'file_id' => $this->fileId,
            'image_url' => $this->imageUrl,
        ], fn ($value) => $value !== null);
    }
}
