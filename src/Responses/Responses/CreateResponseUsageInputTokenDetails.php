<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseUsageInputTokenDetails
{
    private function __construct(
        public readonly int $cachedTokens,
    ) {}

    /**
     * @param  array{cached_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['cached_tokens'],
        );
    }

    /**
     * @return array{cached_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'cached_tokens' => $this->cachedTokens,
        ];
    }
}
