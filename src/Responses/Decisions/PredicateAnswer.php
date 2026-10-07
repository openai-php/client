<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

/**
 * @phpstan-type PredicateAnswerType array{type: 'predicate', name: string, probability: float}
 */
final class PredicateAnswer
{
    private function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly float $probability,
    ) {}

    /**
     * @param  PredicateAnswerType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
            (float) $attributes['probability'],
        );
    }

    /**
     * @return PredicateAnswerType
     */
    public function toArray(): array
    {
        return [
            'type' => 'predicate',
            'name' => $this->name,
            'probability' => $this->probability,
        ];
    }
}
