<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

/**
 * @phpstan-import-type ChoiceProbabilityType from ChoiceProbability
 *
 * @phpstan-type ChoiceAnswerType array{type: 'choice', name: string, choice: string, probabilities: array<int, ChoiceProbabilityType>, confidence: float}
 */
final class ChoiceAnswer
{
    /**
     * @param  array<int, ChoiceProbability>  $probabilities
     */
    private function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly string $choice,
        public readonly array $probabilities,
        public readonly float $confidence,
    ) {}

    /**
     * @param  ChoiceAnswerType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
            $attributes['choice'],
            array_map(
                static fn (array $probability): ChoiceProbability => ChoiceProbability::from($probability),
                $attributes['probabilities'],
            ),
            (float) $attributes['confidence'],
        );
    }

    /**
     * @return ChoiceAnswerType
     */
    public function toArray(): array
    {
        return [
            'type' => 'choice',
            'name' => $this->name,
            'choice' => $this->choice,
            'probabilities' => array_map(
                static fn (ChoiceProbability $probability): array => $probability->toArray(),
                $this->probabilities,
            ),
            'confidence' => $this->confidence,
        ];
    }
}
