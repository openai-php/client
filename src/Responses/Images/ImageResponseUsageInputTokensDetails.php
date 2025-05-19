<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{text_tokens: int, image_tokens: int}>
 */
final class ImageResponseUsageInputTokensDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{text_tokens: int, image_tokens: int}>
     */
    use ArrayAccessible;
    use Fakeable;

    private function __construct(
        public readonly int $textTokens,
        public readonly int $imageTokens,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{text_tokens: int, image_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['text_tokens'],
            $attributes['image_tokens'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'text_tokens' => $this->textTokens,
            'image_tokens' => $this->imageTokens,
        ];
    }
} 