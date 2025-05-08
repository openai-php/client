<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type InputTokenDetailsType array{cached_tokens: int}
 *
 * @implements ResponseContract<InputTokenDetailsType>
 */
final class CreateResponseUsageInputTokenDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<InputTokenDetailsType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $cachedTokens,
    ) {}

    /**
     * @param  InputTokenDetailsType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            cachedTokens: $attributes['cached_tokens'],
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
