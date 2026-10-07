<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

/**
 * @phpstan-type ChoiceProbabilityType array{value: string, probability: float}
 */
final class ChoiceProbability
{
    private function __construct(
        public readonly string $value,
        public readonly float $probability,
    ) {}

    /**
     * @param  ChoiceProbabilityType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['value'],
            (float) $attributes['probability'],
        );
    }

    /**
     * @return ChoiceProbabilityType
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'probability' => $this->probability,
        ];
    }
}
