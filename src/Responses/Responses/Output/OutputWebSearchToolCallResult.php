<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputWebSearchToolCallResultType array{type: 'image_result', image_url: string, source_website_url: string, thumbnail_url?: string, caption?: string}
 *
 * @implements ResponseContract<OutputWebSearchToolCallResultType>
 */
final class OutputWebSearchToolCallResult implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputWebSearchToolCallResultType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'image_result'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $imageUrl,
        public readonly string $sourceWebsiteUrl,
        public readonly ?string $thumbnailUrl,
        public readonly ?string $caption,
    ) {}

    /**
     * @param  OutputWebSearchToolCallResultType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            imageUrl: $attributes['image_url'],
            sourceWebsiteUrl: $attributes['source_website_url'],
            thumbnailUrl: $attributes['thumbnail_url'] ?? null,
            caption: $attributes['caption'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'image_url' => $this->imageUrl,
        ];

        if ($this->thumbnailUrl !== null) {
            $data['thumbnail_url'] = $this->thumbnailUrl;
        }

        $data['source_website_url'] = $this->sourceWebsiteUrl;

        if ($this->caption !== null) {
            $data['caption'] = $this->caption;
        }

        return $data;
    }
}
