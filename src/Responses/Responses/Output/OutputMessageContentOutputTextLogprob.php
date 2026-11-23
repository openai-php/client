<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type TopLogprobType from OutputMessageContentOutputTextTopLogprob
 *
 * @phpstan-type LogprobType array{token: string, logprob: float, bytes: array<int, int>, top_logprobs: array<int, TopLogprobType>}
 *
 * @implements ResponseContract<LogprobType>
 */
final class OutputMessageContentOutputTextLogprob implements ResponseContract
{
    /**
     * @use ArrayAccessible<LogprobType>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, int>  $bytes
     * @param  array<int, OutputMessageContentOutputTextTopLogprob>  $topLogprobs
     */
    private function __construct(
        public readonly string $token,
        public readonly float $logprob,
        public readonly array $bytes,
        public readonly array $topLogprobs,
    ) {}

    /**
     * @param  LogprobType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            token: $attributes['token'],
            logprob: $attributes['logprob'],
            bytes: $attributes['bytes'],
            topLogprobs: array_map(
                fn (array $topLogprob): OutputMessageContentOutputTextTopLogprob => OutputMessageContentOutputTextTopLogprob::from($topLogprob),
                $attributes['top_logprobs'],
            ),
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
            'top_logprobs' => array_map(
                fn (OutputMessageContentOutputTextTopLogprob $topLogprob): array => $topLogprob->toArray(),
                $this->topLogprobs,
            ),
        ];
    }
}
