<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type TopLogprobType array{token: string, logprob: float, bytes: array<int, int>}
 *
 * @implements ResponseContract<TopLogprobType>
 */
final class OutputMessageContentOutputTextTopLogprob implements ResponseContract
{
    /**
     * @use ArrayAccessible<TopLogprobType>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, int>  $bytes
     */
    private function __construct(
        public readonly string $token,
        public readonly float $logprob,
        public readonly array $bytes,
    ) {}

    /**
     * @param  TopLogprobType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            token: $attributes['token'],
            logprob: $attributes['logprob'],
            bytes: $attributes['bytes'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'logprob' => $this->logprob,
            'bytes' => $this->bytes,
        ];
    }
}
