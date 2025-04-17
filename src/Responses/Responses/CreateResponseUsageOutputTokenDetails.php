<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{reasoning_tokens: int}>
 */
final class CreateResponseUsageOutputTokenDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{reasoning_tokens: int}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $reasoningTokens,
    ) {}

    /**
     * @param  array{reasoning_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['reasoning_tokens'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'reasoning_tokens' => $this->reasoningTokens,
        ];
    }
}
