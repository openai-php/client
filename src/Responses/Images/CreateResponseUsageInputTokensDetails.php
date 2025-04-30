<?php

namespace OpenAI\Responses\Images;

class CreateResponseUsageInputTokensDetails
{
    private function __construct(
        public readonly int $imageTokens,
        public readonly int $textTokens
    ) {}

    /**
     * @param  array{image_tokens:int, text_tokens:int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['image_tokens'],
            $attributes['text_tokens'],
        );
    }

    /**
     * @return array{image_tokens:int, text_tokens:int}
     */
    public function toArray(): array
    {
        return [
            'image_tokens' => $this->imageTokens,
            'text_tokens' => $this->textTokens,
        ];
    }
}
