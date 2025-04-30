<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

final class ImageResponseUsageInputTokensDetails
{
    private function __construct(
        public readonly int $textTokens,
        public readonly int $imageTokens,
    ) {}

    /**
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
     * @return array{text_tokens: int, image_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'text_tokens' => $this->textTokens,
            'image_tokens' => $this->imageTokens,
        ];
    }
}
