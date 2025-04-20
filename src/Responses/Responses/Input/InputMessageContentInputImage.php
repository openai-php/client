<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'input_image', detail: string, file_id: string|null, image_url: string|null}>
 */
final class InputMessageContentInputImage implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'input_image', detail: string, file_id: string|null, image_url: string|null}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param 'input_image' $type
     * @param string $detail
     * @param string|null $file_id
     * @param string|null $image_url
     */
    private function __construct(
        public readonly string $type,
        public readonly string $detail,
        public readonly ?string $file_id,
        public readonly ?string $image_url,
    ) {}

    /**
     * @param array{type: 'input_image', detail: string, file_id: string|null, image_url: string|null} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            detail: $attributes['detail'],
            file_id: $attributes['file_id'],
            image_url: $attributes['image_url'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'detail' => $this->detail,
            'file_id' => $this->file_id,
            'image_url' => $this->image_url,
        ];
    }
}