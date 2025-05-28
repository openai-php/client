<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputTokenDetailsType array{reasoning_tokens: int}
 *
 * @implements ResponseContract<OutputTokenDetailsType>
 */
final class CreateResponseUsageOutputTokenDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputTokenDetailsType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $reasoningTokens,
    ) {}

    /**
     * @param  OutputTokenDetailsType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            reasoningTokens: $attributes['reasoning_tokens'],
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
