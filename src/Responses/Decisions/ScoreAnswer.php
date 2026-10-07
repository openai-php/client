<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

/**
 * @phpstan-import-type ScoreProbabilityType from ScoreProbability
 *
 * @phpstan-type ScoreAnswerType array{type: 'score', name: string, score: float, probabilities: array<int, ScoreProbabilityType>, confidence: float}
 */
final class ScoreAnswer
{
    /**
     * @param  array<int, ScoreProbability>  $probabilities
     */
    private function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly float $score,
        public readonly array $probabilities,
        public readonly float $confidence,
    ) {}

    /**
     * @param  ScoreAnswerType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
            (float) $attributes['score'],
            array_map(
                static fn (array $probability): ScoreProbability => ScoreProbability::from($probability),
                $attributes['probabilities'],
            ),
            (float) $attributes['confidence'],
        );
    }

    /**
     * @return ScoreAnswerType
     */
    public function toArray(): array
    {
        return [
            'type' => 'score',
            'name' => $this->name,
            'score' => $this->score,
            'probabilities' => array_map(
                static fn (ScoreProbability $probability): array => $probability->toArray(),
                $this->probabilities,
            ),
            'confidence' => $this->confidence,
        ];
    }
}
