<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseUsagePromptTokensDetails
{
    private function __construct(
        public readonly ?int $audioTokens,
        public readonly ?int $imageTokens,
        public readonly ?int $textTokens,
    ) {
    }

    /**
     * @param array{audio_tokens?:int|null, image_tokens?:int|null, text_tokens?:int|null} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['audio_tokens'] ?? null,
            $attributes['image_tokens'] ?? null,
            $attributes['text_tokens'] ?? null,
        );
    }

    /**
     * @return array{audio_tokens?:int, image_tokens?:int, text_tokens?:int}
     */
    public function toArray(): array
    {
        $result = [];

        if (! is_null($this->audioTokens)) {
            $result['audio_tokens'] = $this->audioTokens;
        }

        if (! is_null($this->imageTokens)) {
            $result['image_tokens'] = $this->imageTokens;
        }

        if (! is_null($this->textTokens)) {
            $result['text_tokens'] = $this->textTokens;
        }

        return $result;
    }
} 