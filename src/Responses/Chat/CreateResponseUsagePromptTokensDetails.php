<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseUsagePromptTokensDetails
{
    private function __construct(
        public readonly ?int $audioTokens,
        public readonly int $cachedTokens
    ) {}

    /**
     * @param  array{audio_tokens?:int|null, cached_tokens?:int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['audio_tokens'] ?? null,
            $attributes['cached_tokens'] ?? 0,
        );
    }

    /**
     * @return array{cached_tokens: int, audio_tokens?:int}
     */
    public function toArray(): array
    {
        $result = [
            'cached_tokens' => $this->cachedTokens,
        ];

        if (! is_null($this->audioTokens)) {
            $result['audio_tokens'] = $this->audioTokens;
        }

        return $result;
    }
}
