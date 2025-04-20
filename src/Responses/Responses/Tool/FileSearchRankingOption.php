<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ranker: string, score_threshold: float}>
 */
final class FileSearchRankingOption implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ranker: string, score_threshold: float}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $ranker,
        public readonly float $scoreThreshold,
    ) {}

    /**
     * @param  array{ranker: string, score_threshold: float}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            ranker: $attributes['ranker'],
            scoreThreshold: $attributes['score_threshold'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ranker' => $this->ranker,
            'score_threshold' => $this->scoreThreshold,
        ];
    }
}
