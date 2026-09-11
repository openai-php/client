<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseUsagePromptTokensDetails
{
    private function __construct(
        public readonly ?int $audioTokens,
        public readonly int $cachedTokens,
        public readonly ?int $cacheWriteTokens = null,
    ) {}

    /**
     * @param  array{audio_tokens?:int|null, cached_tokens?:int, cache_write_tokens?:int|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['audio_tokens'] ?? null,
            $attributes['cached_tokens'] ?? 0,
            $attributes['cache_write_tokens'] ?? null,
        );
    }

    /**
     * @return array{cached_tokens: int, audio_tokens?:int, cache_write_tokens?:int}
     */
    public function toArray(): array
    {
        $result = [
            'cached_tokens' => $this->cachedTokens,
        ];

        if (! is_null($this->audioTokens)) {
            $result['audio_tokens'] = $this->audioTokens;
        }

        if (! is_null($this->cacheWriteTokens)) {
            $result['cache_write_tokens'] = $this->cacheWriteTokens;
        }

        return $result;
    }
}
