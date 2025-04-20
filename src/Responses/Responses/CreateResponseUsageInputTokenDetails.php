<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{cached_tokens: int}>
 */
final class CreateResponseUsageInputTokenDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{cached_tokens: int}>
     */
    use ArrayAccessible;

    use Fakeable;

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
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'cached_tokens' => $this->cachedTokens,
        ];
    }
}
