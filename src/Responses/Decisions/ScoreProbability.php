<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

/**
 * @phpstan-type ScoreProbabilityType array{value: int, label: string, probability: float}
 */
final class ScoreProbability
{
    private function __construct(
        public readonly int $value,
        public readonly string $label,
        public readonly float $probability,
    ) {}

    /**
     * @param  ScoreProbabilityType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['value'],
            $attributes['label'],
            (float) $attributes['probability'],
        );
    }

    /**
     * @return ScoreProbabilityType
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->label,
            'probability' => $this->probability,
        ];
    }
}
