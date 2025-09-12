<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations\Objects\MessageTypes;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ComputerScreenshotContentType array{file_id: string|null, image_url: string|null, type: 'computer_screenshot'}
 *
 * @implements ResponseContract<ComputerScreenshotContentType>
 */
final class ComputerScreenshotContent implements ResponseContract
{
    /**
     * @use ArrayAccessible<ComputerScreenshotContentType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'computer_screenshot'  $type
     */
    private function __construct(
        public readonly ?string $fileId,
        public readonly ?string $imageUrl,
        public readonly string $type
    ) {}

    /**
     * @param  ComputerScreenshotContentType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            fileId: $attributes['file_id'] ?? null,
            imageUrl: $attributes['image_url'] ?? null,
            type: $attributes['type'],
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
            'type' => $this->type,
        ];
    }
}
