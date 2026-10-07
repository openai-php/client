<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

/**
 * @phpstan-type RefusalAnswerType array{type: 'refusal', name: string}
 */
final class RefusalAnswer
{
    private function __construct(
        public readonly string $type,
        public readonly string $name,
    ) {}

    /**
     * @param  RefusalAnswerType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
        );
    }

    /**
     * @return RefusalAnswerType
     */
    public function toArray(): array
    {
        return [
            'type' => 'refusal',
            'name' => $this->name,
        ];
    }
}
